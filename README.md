## Comments
For the task need and its simplification some corners had to be cut.
There is no permanent persistence layer - all results are stored in memory and it resulted in a lack of functional tests.
Application would need some additional work to be able to work in a production environment: 
new persistence layer port should be implemented (Doctrine for example).
Then we could use new port implementation to be used within functional test where MySQL would be hosted by Docker.
To add functional test we should implement some fake classes and inject them through environment dedicated services.yaml.

Nevertheless logs and command output work as expected. 

Integration logs are stored in var/log/dev_integration-TIMESTAMP.log

Although at this very moment suppliers available are:
- XYZLogistics (supplier1.xml)
- SuperDistribution (supplier2.xml)
- AwesomeSixEleven (supplier3.xml)
  
Integration can be tested with make instruction (see Makefile section below).
  
## Purpose of the application

The application is used to download products data from external suppliers. The data has to be downloaded from 
suppliers and displayed in a table form in the console. The data comes in different formats from different suppliers.
In addition, the supplier information and product ID should be saved to the event log in the disk, the data should be 
logged into one file.

To simplify the task, the response from external providers is simulated by reading files from the "web" directory. 
Access to other directories from the browser level should be blocked.

The command is called through: `php bin/console divante:supplier-sync name_supplier`

## Task Requirements

- Webserver to serve the files
- PHP 8.0+
- Composer

### Technical

- Easy to add more suppliers.
- Easy ability to add more data formats.
- Adding the ability to log product information.

## Design
Application communication is based on Symfony Messenger.
Whole platform was put together using DDD, Hexagonal and Onion design. 
Project communicates using CQRS (Command Query Responsibility Separation) pattern.
Persistence layer was simplified by using memory as a persistence service to cut some corners in a production 
environment InMemory implementation should be replaced by proper port like Doctrine.
## Adding content
### Adding new format
Since formats are inseparable part of connector, to implement support you need to create new Infrastructure/API/Integration/AbstractConnector implementation.
### Adding new supplier
Steps you need to make to implement a new supplier:
- Add a supplier's implementation of Domain/Integration/IntegrationProductInterface.php in src/Core/Domain/Integration/IntegrationProduct
- Create new supplier connector in src/Core/Infrastructure/API/Integration/Connector, extending AbstractConnector designated for supplier's feed format. If data format is currently unsupported se Adding new format paragraph above.
- Add a new supplier's name to supplier's dictionary in Infrastructure/API/Integration/ConnectorConfigurationDictionary
- Add a new connector to ConnectorFactory configuration which is loaded in Infrastructure/API/Integration/ConnectorFactory 

## Makefile
MAKEFILE in a directory delivers commands:

    1. make start             - Launching docker containers in background
    1. make stop              - Stops docker containers
    2. make build             - Runs init command within running docker containers
    3. make cli_php           - Sh access to php container
    4. make phpunit           - Launch phpunit in php
    5. make phpstan-analyse   - Launch phpstan in php (composer.json requirements have to be met on host computer)
    6. make integration_sup_1 - Launches integration for supplier XYZLogistics (supplier1.xml) 
    7. make integration_sup_2 - Launches integration for supplier SuperDistribution (supplier2.xml)
    8. make integration_sup_3 - Launches integration for supplier AwesomeSixEleven (supplier3.xml)

How to use: $ make command

## Libraries / frameworks used

Software used in project include:

- [Docker](https://www.docker.com/)
- [Symfony 5](https://symfony.com/)
- [symfony/messenger](https://github.com/symfony/messenger)
- [ramsey/uuid](https://github.com/ramsey/uuid)
- [myclabs/php-enum](https://github.com/myclabs/php-enum)
- [sabre/xml](https://github.com/sabre/xml)

## License

[MIT](LICENSE)