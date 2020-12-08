# EBMS 4.0
This version of the PDQ® Editorial Board Management System has been rewritten to use Drupal 9.x. The project directory was initialized with the command `composer create-project drupal/recommended-project ebms4`.

## Developer Setup

To create a local development environment for this project, perform the following steps.

1. Clone the repository.
2. Change current directory to the cloned repository.
3. Run `composer install`.
4. Run `docker-compose up -d`.
5. Run `docker exec -it ebms4_web_1 bash`.
6. Inside the container, run `./install.sh`.
7. Point your favorite browser to http://ebms.localhost:8081/user/login.
8. Log in as admin/pdq5ecre7.
