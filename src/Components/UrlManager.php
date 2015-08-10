<?php

namespace Components;

use Exceptions\IncorrectUrlException;

class UrlManager
{
    const ACTION_GET = 'get';
    const ACTION_GET_BATCH = 'getBatch';
    const ACTION_ADD = 'add';
    const ACTION_EDIT = 'edit';
    const ACTION_DELETE = 'delete';

    /**
     * @return array
     */
    public static function getAvailableActions()
    {
        return [
            self::ACTION_GET,
            self::ACTION_GET_BATCH,
            self::ACTION_ADD,
            self::ACTION_EDIT,
            self::ACTION_DELETE,
        ];
    }

    /**
     * @return array|null|string
     * @throws IncorrectUrlException
     */
    public function getAction()
    {
        $action = null;
        //to avoid recursion, actual index content must be in separate script
        if ($_SERVER['REQUEST_URI'] == '/' || $_SERVER['REQUEST_URI'] == '/index')
        {
            return self::ACTION_GET_BATCH;
        }
        $action = substr($_SERVER['REQUEST_URI'], 1);

        if (!in_array($action, self::getAvailableActions())) {
            throw new IncorrectUrlException('Incorrect request');
        }

        return $action;
    }
}