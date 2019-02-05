# Ads

## 3WA/SensioLabsUniversity Project

### First step

-  [Template](https://www.free-css.com/free-css-templates/page220/gp)
- User Entity created (with constraints and Unique Entity)
- plainPasswordField
- SecurityController with register, login and logout methods.
- Set up config/packages/security.yaml (encoder, provider and firewall).
- RegistrationFormType.
- login.html.twig and register.html.twig
- AgreeTerms and remember_me
- UserFixtures
- Condition "is_granted" in navbar.

Security DOC:  
[SF DOC Security](https://symfony.com/doc/current/security.html)   
[SFDOC LOGIN FORM](https://symfony.com/doc/current/security/form_login_setup.html)  
[SF DOC form_login Authentication Provider](https://symfony.com/doc/current/security/form_login.html)  
[SF DOC remember me functionality](https://symfony.com/doc/current/security/remember_me.html)  
[SF DOC CSRF protection](https://symfony.com/doc/current/security/csrf.html)
[SF DOC registration form](https://symfony.com/doc/current/doctrine/registration_form.html)  
[SymfonyCasts Security](https://symfonycasts.com/screencast/symfony-security)

- Advert Entity created (with constraints and Unique Entity)  
- relation ManyToOne with User Entity (author field).
- AdvertController, AdvertFixtures, for loop in Twig to see all adverts.
- Twig view to see one advert.
- Pagination done.
- AddAdvertType form created.
- CRUD done with this entity.

DOC:
[SF DOC Doctrine](https://symfony.com/doc/current/doctrine.html)
[SF DOC Relations](https://symfony.com/doc/current/doctrine/associations.html)
[SF DOC Fixtures](https://symfony.com/doc/current/bundles/DoctrineFixturesBundle/index.html)
[SF DOC Validation](https://symfony.com/doc/current/validation.html)
[SymfonyCasts Pagination](https://symfonycasts.com/screencast/doctrine-relations/pagination)

- Application Entity created
- relation ManyToOne with User Entity (author field)
- relation ManyToOne with Advert Entity (advert field)
- ApplicationController,  ApplicationType form.
- possibility to send an application to an advert.

### Step 2

- Category Entity created (with constraints and Unique Entity)
- relation ManyToMany with Advert Entity ( categories field).
- addAdvertType modified (EntityType, class Category, multiple)
- CategoryFixtures and categories can be seen in templates (index & view.html.twig)
- Add and Edit an advert with some categories works.
- We have now 4 entities :
1) User related to Advert (OneToMany) and Application (OneToMany).
2) Advert related to User (ManyToOne), Application (OneToMany) and Category (ManyToMany).
3) Application related to User (ManyToOne) and Advert (ManyToOne).
4) Category related to Advert (ManyToMany).

### Step 3

- Department Entity created 
- relation OneToMany with Advert Entity (department field).
- DepartmentType form created.
- addAdvertType modified including DepartmentType so that we can see now where the advert is.
- DepartmentFixtures has been done with all french departments.
- Admin part has been enhanced:
- Admin can now change the User's role.
- Admin can now validate an advert.
- Admin can add or delete a category.

### Step 3

- Start Account Page
- Possibility to see my created adverts
- Possibility to see applications for those adverts.
- Add Flash messages.
- Todo: search form and possibility for a user to send a file, Set recruiter and user roles.


