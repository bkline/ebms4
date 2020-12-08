# EBMS 4.0
This version of the PDQ® Editorial Board Management System has been rewritten to use Drupal 9.x. The project directory was initialized with the command `composer create-project drupal/recommended-project ebms4`.

## Developer Setup

To create a local development environment for this project, perform the following steps.

1. Clone the repository.
2. Change current directory to the cloned repository.
3. Run `composer install`.
4. Run `exec -it ebms4_web_1 bash`.
5. Inside the container, run `./install.sh`.
