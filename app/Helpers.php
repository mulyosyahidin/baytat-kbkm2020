<?php

use App\Models\Setting;
use App\Models\Social_link;

if (!function_exists('getSettings')) {
    function getSettings($key)
    {
        $setting = Setting::select('content')
            ->where('key', $key)
            ->first();

        return $setting->content;
    }
}

if (!function_exists('getSiteName')) {
    function getSiteName()
    {
        return getSettings('siteName');
    }
}

if (!function_exists('getCurrentTheme')) {
    function getCurrentTheme()
    {
        return getSettings('currentTheme');
    }
}

if (!function_exists('getThemeUri')) {
    function getThemeUri($file)
    {
        $theme = getCurrentTheme();

        if (file_exists('../public/assets/themes/' . $theme . '/' . $file) && is_file('../public/assets/themes/' . $theme . '/' . $file)) {
            return asset('assets/themes/' . $theme . '/' . $file);
        } else {
            return '{{ FILE_NOT_FOUND }}';
        }
    }
}

if (!function_exists('getController')) {
    function getController()
    {
        $action = app('request')->route()->getAction();
        $route = class_basename($action['controller']);

        list($controller, $action) = explode('@', $route);

        return $controller;
    }
}

if (!function_exists('getAction')) {
    function getAction()
    {
        $action = app('request')->route()->getAction();
        $route = class_basename($action['controller']);

        list($controller, $action) = explode('@', $route);

        return $action;
    }
}

if (!function_exists('isController')) {
    function isController($controller)
    {
        return ($controller === getController());
    }
}

if (!function_exists('isAction')) {
    function isAction($action)
    {
        return ($action === getAction());
    }
}

if (!function_exists('__active')) {
    function __active($controller = '', $action = '')
    {
        if ($controller === '' && $action === '') {
            return ' active';
        }
        else if (is_array($controller) && count($controller) > 0) {
            foreach ($controller as $c) {
                if (isController($c)) {
                    return ' active';
                    break;
                }
            }
        }
        else if ($controller !== '' && $action === '') {
            return isController($controller) ? ' active' : '';
        }
        else if (is_array($action) && count($action) > 0) {
            foreach ($action as $method) {
                if (isController($controller) && isAction($method)) {
                    return ' active';
                    break;
                }
            }
        } else if (isController($controller) && isAction($action)) {
            return ' active';
        }
    }
}

if (!function_exists('getSocialLinks')) {
    function getSocialLinks()
    {
        $links = Social_link::all();

        return $links;
    }
}

if (!function_exists('getAdminPicture')) {
    function getAdminPicture()
    {
        if (isset(Auth::user()->media[0])) {
            return Auth::user()->media[0]->getFullUrl();
        }
    }
}

if (!function_exists('getSiteLogo')) {
    function getSiteLogo()
    {
        $setting = Setting::find(3);

        if (isset($setting->media[0])) {
            return $setting->media[0]->getFullUrl();
        } else {
            return NULL;
        }
    }
}

if ( ! function_exists('createAcronym'))
{
    function createAcronym($words)
    {
        $acronym = '';
        $words = explode(' ', $words);
        foreach ($words as $word)
        {
            $first_letter = str_split($word);

            $acronym .= $first_letter[0];
        }

        return $acronym;
    }
}