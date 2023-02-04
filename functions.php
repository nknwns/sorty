<?php

function check_sql_error($DB) {
    if (mysqli_errno($DB)) {
        header('Location: /pages/error.php');
        exit;
    }
}

function get_user($DB, $id) {
    $sql = "SELECT * FROM `users` WHERE `id` = " . $id;
    $data = mysqli_query($DB, $sql);
    check_sql_error($DB);
    $user = mysqli_fetch_assoc($data);

    preg_match("~([^\s])[^\s]* ([^\s])[^\s]*~u", $user['name'], $short_name);
    $user['short'] = $short_name[1] . $short_name[2];

    return $user;
}

function get_users($DB, $ids) {
    $sql = "SELECT * FROM `users` WHERE `id` IN (" . join(',', $ids) . ")";
    $data = mysqli_query($DB, $sql);
    check_sql_error($DB);
    $users = array();
    while ($user = mysqli_fetch_assoc($data)) {
        preg_match("~([^\s])[^\s]* ([^\s])[^\s]*~u", $user['name'], $short_name);
        $user['short'] = $short_name[1] . $short_name[2];
        $users[$user['id']] = $user;
    }

    return $users;
}

function get_last_message_for_channel($DB, $id) {
    $sql = "SELECT * FROM `SMS` WHERE `channel_id` = " . $id . ' AND (`save` = 0 OR `user_id` = ' . $_SESSION['id'] . ') ORDER BY `id` DESC LIMIT 1';
    $data = mysqli_query($DB, $sql);
    check_sql_error($DB);
    $message = mysqli_fetch_assoc($data);

    return $message;
}

function get_messages_for_channel($DB, $id, $filter=null) {
    $sql = "SELECT * FROM `SMS` WHERE `channel_id` = " . $id . " AND (`save` = 0 OR `user_id` = " . $_SESSION['id'] . ")";
    if (!is_null($filter)) {
        $sql_ = "SELECT `id` FROM `#` WHERE `name` = '" . $filter . "'";
        $data_ = mysqli_query($DB, $sql_);
        check_sql_error($DB);

        if (!mysqli_num_rows($data_)) {
            return array();
        }

        $sql .= "AND `#_id` = " . mysqli_fetch_row($data_)[0];
    }

    $data = mysqli_query($DB, $sql);
    check_sql_error($DB);
    $messages = array();
    while ($message = mysqli_fetch_assoc($data)) array_push($messages, $message);

    $tag_ids = array();
    foreach($messages as $message) {
        if (!is_null($message['#_id']) && !in_array($message['#_id'], $tag_ids)) array_push($tag_ids, $message['#_id']);
    }

    if (count($tag_ids)) {
        $tag_to_field_array = array();

        $sql = "SELECT * FROM `#_field` WHERE `id_#` IN (" . join(',', $tag_ids) . ")";
        $data = mysqli_query($DB, $sql);
        check_sql_error($DB);

        $field_ids = array();
        while ($tag = mysqli_fetch_assoc($data)) {
            $tag_to_field_array[$tag['id_#']] = $tag['id_field'];
            if (!in_array($tag['id_field'], $field_ids)) array_push($field_ids, $tag['id_field']);
        }

        $sql = "SELECT * FROM `field` WHERE `id` IN ( ". join(',', $field_ids) . ")";
        $data = mysqli_query($DB, $sql);
        check_sql_error($DB);

        $fields = array();
        while ($field = mysqli_fetch_assoc($data)) {
            $fields[$field['id']] = $field['name'];
        }

        foreach($messages as $key => $message) {
            if (!is_null($message['#_id'])) {
                $field_id = $tag_to_field_array[$message['#_id']];
                $messages[$key]['field'] = $fields[$field_id];
                $messages[$key]['description'] = trim(preg_replace("~\s#[\w]+~u", '<a href="http://sorty.std-1715.ist.mospolytech.ru/index.php?t=fields&v=tags&id=' . $field_id .'" class="label message-tag tooltip" data-tooltip="' . $fields[$field_id] . '">$0</a>', " " . $message['description'] . " "));
            }
        }

    }


    return $messages;
}

function get_channel($DB, $id) {
    $sql = "SELECT * FROM `channels` WHERE `id` = " . $id;
    $data = mysqli_query($DB, $sql);
    check_sql_error($DB);
    $channel = mysqli_fetch_assoc($data);

    return $channel;
}

function get_channels($DB, $is_favorites) {
    $sql = "SELECT * FROM `channels`";
    if ($is_favorites) $sql .= " WHERE `liked` = 1";
    $data = mysqli_query($DB, $sql);
    check_sql_error($DB);
    $channels = array();
    while ($channel = mysqli_fetch_assoc($data)) array_push($channels, $channel);

    return $channels;
}

function toggle_channel($DB, $id, $is_favorite) {
    $sql = "UPDATE `channels` SET `liked` = " . (((int)$is_favorite + 1) % 2) . " WHERE `id` = " . $id;
    mysqli_query($DB, $sql);
    check_sql_error($DB);
    if ((int)$is_favorite) {
        $_SESSION['notify'] = 'Вы больше не доверяете данному каналу';
    } else {
        $_SESSION['notify'] = 'Канал добавлен в список доверенных';
    }
}

function get_fields($DB) {
    $sql = "SELECT * FROM `field`";
    $data = mysqli_query($DB, $sql);
    check_sql_error($DB);
    $fields = array();
    while ($field = mysqli_fetch_assoc($data)) {
        $sql = "SELECT count(*) FROM `#_field` WHERE `id_field` = " . $field['id'];
        $temp = mysqli_query($DB, $sql);
        check_sql_error($DB);;

        $field['count'] = mysqli_fetch_row($temp)[0];
        array_push($fields, $field);
    }
    return $fields;
}

function get_field($DB, $id) {
    $sql = "SELECT * FROM `field` WHERE `id` = " . $id;
    $data = mysqli_query($DB, $sql);
    check_sql_error($DB);
    $field = mysqli_fetch_assoc($data);

    $sql = "SELECT count(*) FROM `#_field` WHERE `id_field` = " . $field['id'];
    $temp = mysqli_query($DB, $sql);
    check_sql_error($DB);;

    $field['count'] = mysqli_fetch_row($temp)[0];

    return $field;
}

function get_tags($DB, $id) {
    $sql = "SELECT * FROM `#_field` WHERE `id_field` = " . $id;
    $data = mysqli_query($DB, $sql);
    check_sql_error($DB);
    $tags_ = array();
    while ($field_to_tag = mysqli_fetch_assoc($data)) array_push($tags_, $field_to_tag['id_#']);

    $sql = "SELECT * FROM `#` WHERE `id` IN (" . join(',', $tags_) . ")";
    $data = mysqli_query($DB, $sql);
    check_sql_error($DB);
    $tags = array();
    while ($tag = mysqli_fetch_assoc($data)) array_push($tags, $tag);

    return $tags;
}

function get_badge($DB, $type) {
    switch ($type) {
        case 'channels': {
            $sql = "SELECT count(*) FROM `channels`";
            break;
        }
        case 'favorites': {
            $sql = "SELECT count(*) FROM `channels` WHERE `liked` = 1";
            break;
        }
        case 'fields': {
            $sql = "SELECT count(*) FROM `field`";
            break;
        }
    }

    $data = mysqli_query($DB, $sql);
    check_sql_error($DB);
    return mysqli_fetch_row($data)[0];
}

?>