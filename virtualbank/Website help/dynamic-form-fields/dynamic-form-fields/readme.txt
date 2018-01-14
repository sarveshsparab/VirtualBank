How to use this script:

1. Create a DB tabke using the SQL below:

CREATE TABLE products (
	`id` INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
	`name` VARCHAR(255) NOT NULL DEFAULT '',
	`qty` INT UNSIGNED NOT NULL DEFAULT 0
) DEFAULT CHARSET=utf8

2. Open dynamic-form-fields.html.php and edit the DB connection details that are in the beginning

3. Run it

Do not use this scirpt in production as-is. You shouldn't use mysqli_query directly without a DB wrapper. And some of the queries can be optimized as suggested in the comments inside.


LICENSE

Free for everything you may want to do with it.