<?php

namespace NewsProvider;

class NewsProviderFactory
{
    const PROVIDER_DB = 'db';
    const PROVIDER_FILE = 'file';

    /**
     * @return array
     */
    public static function getAvailableProviders()
    {
        return [
            self::PROVIDER_DB,
            self::PROVIDER_FILE
        ];
    }

    /**
     * @param $config
     * @return DBNewsProvider|FileNewsProvider
     */
    public static function getNewsProvider($config)
    {
        $provider = null;
        switch ($config['news_provider']) {
            case self::PROVIDER_DB:
                $provider = new DBNewsProvider($config['db']);
                break;
            case self::PROVIDER_FILE;
                $provider = new FileNewsProvider($config['file']);
                break;
            default:
                $provider = new DBNewsProvider($config['db']);
        }

        return $provider;
    }
}