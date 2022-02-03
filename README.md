Laravel Doctrine Data Fixtures
------------------------------

Laravel has built-in support for 'seed' data.  In seed data, the classes
are not namespaced and many developers treat seed data as a one-time
import.  Seed data often uses auto-increment primary keys.  Perhaps
these notes are what differentiates seed data from Fixtures.

In my fixtures I want static primary keys and I want to be able to
re-run my fixtures at any time.  I want the data my fixtures populate
to be stored with my fixtures and I want to reference fixture values
though class constants within my code.

For instance, to validate a user has an ACL resource the code may 
read:

```php
$acl->has($user, 'admin');
```

but this use of strings in the code does not read well and may be
error-prone.  Instead of the above, I want my code to read

```php
use App\ORM\Fixture\RoleFixture;

$acl->has($user, RoleFixture::admin);
```

This pattern is not possible with seed data because seed data does
not have namespaces.  So, this repository exists not only as an
alternative to Laravel seed data, but as an namespaced-integrated
tool for static database data.
