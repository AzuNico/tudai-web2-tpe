<?php

class NotificationController
{

    public function set($message, $status)
    {
        $alert = [
            'status' => $status,
            'message' => $message
        ];
        // // $_SESSION['alert'] = $alert;
        return $alert;
    }

    public function setSuccess($message)
    {
        $alert = [
            'status' => 'success',
            'message' => $message
        ];
        // $_SESSION['alert'] = $alert;
        return $alert;
    }

    public function setError($message)
    {
        $alert = [
            'status' => 'danger',
            'message' => $message
        ];
        // $_SESSION['alert'] = $alert;
        return $alert;
    }

    public function setWarning($message)
    {
        $alert = [
            'status' => 'warning',
            'message' => $message
        ];
        // $_SESSION['alert'] = $alert;
        return $alert;
    }

    public function setInfo($message)
    {
        $alert = [
            'status' => 'info',
            'message' => $message
        ];
        // $_SESSION['alert'] = $alert;
        return $alert;
    }

    public function clean()
    {
        unset($_SESSION['alert']);
    }
}
