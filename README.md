## Purpose of the application

The application is used to download products data from external suppliers. The data has to be downloaded from 
suppliers and displayed in a table form in the console. The data comes in different formats from different suppliers.
In addition, the supplier information and product ID should be saved to the event log in the disk, the data should be 
logged into one file.

To simplify the task, the response from external providers is simulated by reading files from the "web" directory. 
Access to other directories from the browser level should be blocked.

The command is called through: `php bin/console divante:supplier-sync name_supplier`

Although at this very moment suppliers available are: AwesomeSixEleven, SuperDistribution, XYZLogistics

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
### Adding new supplier
### Adding new format
## Libraries / frameworks used

Software used in project include:

- [Docker](https://www.docker.com/)
- [Symfony 5](https://symfony.com/)
- [ramsey/uuid](https://github.com/ramsey/uuid)
- [myclabs/php-enum](https://github.com/myclabs/php-enum)
- [sabre/xml](https://github.com/sabre/xml)

## License

[MIT](LICENSE)