<?php


namespace Core\Infrastructure\API\Integration;


use MyCLabs\Enum\Enum;

/**
 * @method static ConnectorConfigurationDictionary XYZLOGISTICS()
 * @method static ConnectorConfigurationDictionary SUPERDISTRIBUTION()
 * @method static ConnectorConfigurationDictionary AWESOMESIXELEVEN()
 */
class ConnectorConfigurationDictionary extends Enum
{
    private const XYZLOGISTICS = 'XYZLogistics';
    private const SUPERDISTRIBUTION = 'SuperDistribution';
    private const AWESOMESIXELEVEN = 'AwesomeSixEleven';
}