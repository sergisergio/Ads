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

