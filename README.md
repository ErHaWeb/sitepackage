# <img width="50" height="50" src="Resources/Public/Icons/Extension.svg" alt="TYPO3 CMS Sitepackage"> TYPO3 CMS Sitepackage</div>

This sitepackage sticks as closely as possible to the recommended standard and maps all conceivable functional areas. There are also various examples of common use cases.

For more details there is a documentation link in the comments of each file.

## Features

### Full blown directory and file structure

This sitepackage contains almost all the directories and files (except resource files) you need when creating your own sitepackage.

### Color scheme selector

As an example of how to add new fields to pages records through `ext_tables.sql` and `/Configuration/TCA/Overrides/pages.php` and how to implement custom Symfony Conditions (with files `Configuration/ExpressionLanguage.php`, `Classes/ExpressionLanguage/CustomTypoScriptConditionProvider.php` and `Classes/ExpressionLanguage/FunctionsProvider/CustomConditionFunctionsProvider.php`) to be used in the TypoScript/TSconfig context (`Configuration/TypoScript/Setup/page.typoscript`) this sitepackage contains a method to provide choosable color schemes to backend users.

### Backend Style Customization

This sitepackage can customize the TYPO3 login mask style (background image, footnote, highlight color, login logo and login logos alt text) and the backend style (backend favicon and logo). It uses the function of `EXT:backend`. But instead of relying on a backend user to set these variables through the extension settings it overrides them in `ext_localconf.php` with the Extension Configuration of this sitepackage in `ext_conf_template.txt` (which is an easier and centralized way).

### Example Backend Layouts

Example BackendLayouts can be found here `Configuration/TsConfig/Page/Default/mod.web_layout.BackendLayouts/` (as part of the always loaded default Page TSconfig) and here `Configuration/TsConfig/Page/Include/mod.web_layout.BackendLayouts` (as part of the user included Page TSconfig).

### Example Custom Content Element

This sitepackage includes an example of a custom content element. Its icon has been defined in `Configuration/Icons.php`, it is registered and configured in `Configuration/TCA/Overrides/tt_content.php` and added to the newContentElement wizard in `Configuration/TsConfig/Page/Include/mod.wizards.newContentElement.wizardItems/common.tsconfig`. The frontend rendering based on EXT:fluid_styled_content is configured in `Configuration/TypoScript/Setup/tt_content/sitepackage_newcontentelement.typoscript` and finally rendered by Fluid template `Resources/Private/Templates/Page/Example.html`.

### Custom ViewHelper

As an example of how to add custom ViewHelpers this sitepackage adds the possibility to modify attributes of the html tag by the `HtmlTagAttributesViewHelper` in file `Classes/ViewHelpers/HtmlTagAttributesViewHelper.php`. The ViewHelper namespace `xmlns:s="http://typo3.org/ns/VendorName/Sitepackage/ViewHelpers"` has been added to the Fluid Template file `Resources/Private/Layouts/Page/Default.html` and it is used to add information about the currently selected layout as data attribute with tag `<s:htmlTagAttributes data="{data-layout:current}"/>`.

### Custom Symfony Command

If you want to run any process from your sitepackage using the command line interface (CLI) such as a time-consuming import of data from an external system, symfony commands are the way to go. A simple example is shown in this sitepackage under `Classes/Command/DoSomethingCommand.php`. Command Classes like this are registered under `Configuration/Services.yaml`.

To run the example command enter the following line: 

Composer-based installation:
```
vendor/bin/typo3 sitepackage:dosomething anyArgument -o anyOptionValue
```
Legacy installation:
```
typo3/sysext/core/bin/typo3 sitepackage:dosomething anyArgument -o anyOptionValue
```

### XML Sitemap configuration

When EXT:seo is loaded, its static TypoScript is automatically included. The sitepackage adds the ability to hide pages in the XML sitemap by setting the sitemap priority to 0 with the constant `Configuration/TypoScript/Constants/plugin/tx_seo.typoscript`. Please make sure to add the following lines to your site configuration to be able to access the sitemap via its human-readable URI `sitemap.xml` if you have not used this sitepackage as a distribution:

```
routeEnhancers:
  PageTypeSuffix:
    type: PageType
    map:
      sitemap.xml: 1533906435
```

### Cross Browser Favicons

Based on resources of [RealFaviconGenerator](https://realfavicongenerator.net/) [v0.16](https://realfavicongenerator.net/change_log#v0.16) the sitepackage includes all recommended cross browser definitions for Favicons / App Icons. The sitepackage adds all html header information in file `Configuration/TypoScript/Setup/page.typoscript`.

The file `Configuration/TypoScript/Setup/browserconfig.typoscript` configures a separete PAGE object with mime type `text/xml` to output the `browserconfig.xml`.

The file `Configuration/TypoScript/Setup/site.webmanifest.typoscript` configures a separete PAGE object with mime type `application/json` to output the `site.webmanifest`.

To be able to also display `browserconfig.xml` and `site.webmanifest` you need to add the following lines in your site configuration if you have not used this sitepackage as a distribution:

```
routeEnhancers:
  PageTypeSuffix:
    type: PageType
    map:
      # The above-mentioned configuration for "sitemap.xml" may already be here. 
      browserconfig.xml: 2943879438
      site.webmanifest: 3478304621
```

**Note:** Since all resources are referenced with paths generated by TYPO3, this solution is compatible with the future changeover by `typo3/cms-composer-installers:4.0`. [Here](https://b13.com/core-insights/typo3-and-composer-weve-come-a-long-way) you can get further information about the changes.

### Site Configuration Auto Initialization

If you install this sitepackage in an empty TYPO3 CMS installation it will create a new site configuration with configuration for `sitemap.xml`, `browserconfig.xml` and `site.webmanifest`, a first root page with a link to the static TSconfig of this sitepackage, a template record with a link to the static TypoScript of this sitepackage and pages records for various HTTP error codes (404, 403, 500, 503 and undefined), which are referenced in the site configuration.

By default the language en-US is used. If you want to change it, just edit the site configuration in your TYPO3 installation under `config/sites/sitepackage/config.yaml`or via the `Site Management > Sites` module in the TYPO3 backend. 

### Ready to use Task Runner for SCSS and JavaScript

This site package provides a [Gulp](https://gulpjs.com/) task runner that handles the following tasks:

- Compile SCSS from `Resources/Public/Scss/` to CSS directory `Resources/Public/Css/`
- Improve backwards compatibility of your CSS code by using the well known [Autoprefixer PostCSS plugin](https://github.com/postcss/autoprefixer)
- Minify JavaScript and CSS files and save them as separate files with ending `*.min.css` / `*.min.js`
- Static JavaScript code analysis with ([JSHint Documentation](https://jshint.com/docs/)), feel free to adjust the configuration file `.jshintrc` to your needs
- Concatenate and minify all JavaScript files from directory `Resources/Public/JavaScript/Src` and save the result under `Resources/Public/JavaScript/Dist`

To initially install Gulp and all necessary modules execute command `npm install`. Now you are able to run all tasks at once by executing command `gulp`. To run specific tasks use `gulp <taskname>`. To get an overview wich tasks can be executed run `gulp --tasks`.

## Basic Structure

- [`Classes`](Classes/) → Contains all PHP Classes
  - [`.htaccess`](Classes/.htaccess) → Prevents public access to directory [`Classes`](Classes/)
  - [`Command`](Classes/Command/) → Contains all PHP Symfony Command Classes
    - [`DoSomethingCommand.php`](Classes/Command/DoSomethingCommand.php) → Example of a custom Symfony Command
  - [`Controller`](Classes/Controller/) → Contains all PHP controller Classes
  - [`Domain`](Classes/Domain/) → Contains all PHP Domain Classes
    - [`Model`](Classes/Domain/Model/) → Contains all PHP Domain Model Classes
    - [`Persistence`](Classes/Domain/Persistence/) → Contains all PHP Domain Persistence Classes
    - [`Repository`](Classes/Domain/Repository/) → Contains all PHP Domain Repository Classes
    - [`Validator`](Classes/Domain/Validator/) → Contains all PHP Domain Validator Classes
  - [`ExpressionLanguage`](Classes/ExpressionLanguage/) → Contains Expression Language Provider PHP Classes
    - [`FunctionsProvider`](Classes/ExpressionLanguage/FunctionsProvider/) → Contains Expression Language Functions Provider PHP Classes
      - [`CustomFunctionsProvider.php`](Classes/ExpressionLanguage/CustomTypoScriptConditionProvider.php) → Custom Expression Language Function Provider
    - [`CustomProvider.php`](Classes/ExpressionLanguage/CustomTypoScriptConditionProvider.php) → Custom Expression Language Provider
  - [`Hook`](Classes/Hook/) → Contains all PHP Hook Classes
  - [`Middleware`](Classes/Middleware/) → Contains all PHP Middleware Classes
  - [`Service`](Classes/Service/) → Contains all PHP Service Classes
  - [`Utility`](Classes/Utility/) → Contains all PHP Utility Classes
  - [`View`](Classes/View/) → Contains all PHP View Classes
  - [`ViewHelpers`](Classes/ViewHelpers/) → Contains all PHP ViewHelper Classes to be used in Fluid
    - [`HtmlTagAttributesViewHelper.php`](Classes/ViewHelpers/HtmlTagAttributesViewHelper.php) → Example ViewHelper file to add HTML tag attributes
- [`Configuration`](Configuration/) → Contains any configuration file for Backend and Frontend
  - [`.htaccess`](Configuration/.htaccess) → Prevents public access to directory [`Configuration`](Configuration/)
  - [`Backend`](Configuration/Backend/) → Contains configuration that is important within the Backend
    - [`AjaxRoutes.php`](Configuration/Backend/AjaxRoutes.php) → Definitions for ajax routes for entry points
    - [`Modules.php`](Configuration/Backend/Modules.php) → Definitions for Modules
    - [`Routes.php`](Configuration/Backend/Routes.php) → Definitions for "regular" routes for entry points
  - [`ExpressionLanguage.php`](Configuration/ExpressionLanguage.php) → Register Expression Language Provider
  - [`Extbase`](Configuration/Extbase/) → Contains folder [`Persistence`](Configuration/Extbase/Persistence/)
    - [`Persistence`](Configuration/Extbase/Persistence/) → Contains PHP file [`Classes.php`](Configuration/Extbase/Persistence/Classes.php)
      - [`Classes.php`](Configuration/Extbase/Persistence/Classes.php) → Extbase persistence mapping for Classes
  - [`FlexForms`](Configuration/FlexForms/) → Contains FlexForm XML files
    - [`FlexFormExample.xml`](Configuration/FlexForms/FlexFormExample.xml) → Example FlexForm file to provide plugin settings
  - [`Form`](Configuration/Form/) → Contains YAML files for form customization
    - [`CustomFormSetup.yaml`](Configuration/Form/CustomFormSetup.yaml) → Customize form configuration
  - [`Icons.php`](Configuration/Icons.php) → Registers custom Icons in the IconRegistry
  - [`RTE`](Configuration/RTE/) → Contains YAML files for RTE customization
    - [`RteConfig.yaml`](Configuration/RTE/RteConfig.yaml) → Customize RTE configuration
  - [`RequestMiddlewares.php`](Configuration/RequestMiddlewares.php) → Middleware Configuration for Frontend and Backend
  - [`Services.yaml`](Configuration/Services.yaml) → Configuration for automatic Symfony Service loading
  - [`TCA`](Configuration/TCA/) → Contains Table Configuration Array PHP files and Overrides
    - [`Overrides`](Configuration/TCA/Overrides/) → Contains [`TCA`](Configuration/TCA/) Override PHP files
      - [`pages.php`](Configuration/TCA/Overrides/pages.php) → Override [`TCA`](Configuration/TCA/) for table `pages`  (e.g. add Page TSconfig includes)
      - [`sys_template.php`](Configuration/TCA/Overrides/sys_template.php) → Override TCA for table `sys_template` (e.g. add TypoScript templates)
      - [`tt_content.php`](Configuration/TCA/Overrides/tt_content.php) → Override [`TCA`](Configuration/TCA/) for table `tt_content` (e.g. prepare custom content elements)
  - [`TsConfig`](Configuration/TsConfig/) → Any TSconfig file for backend related adjustments
    - [`Page`](Configuration/TsConfig/Page/) → Contains Page TSconfig files for backend configuration (primarily modules)
      - [`Default`](Configuration/TsConfig/Page/Default/) → Page TSconfig from [`Default`](Configuration/TsConfig/Page/Default/) directory is always included
      - [`Include`](Configuration/TsConfig/Page/Include/) → Page TSconfig from [`Include`](Configuration/TsConfig/Page/Include/) directory can be included manually
        - [`RTE.tsconfig`](Configuration/TsConfig/Page/Include/RTE.tsconfig) → Customize RTE configuration
        - [`TCAdefaults.tsconfig`](Configuration/TsConfig/Page/Include/TCAdefaults.tsconfig) → Override default values of [`TCA`](Configuration/TCA/)
        - [`TCEFORM.tsconfig`](Configuration/TsConfig/Page/Include/TCEFORM.tsconfig) → Detailed configuration of how editing forms are rendered
        - [`TCEMAIN.tsconfig`](Configuration/TsConfig/Page/Include/TCEMAIN.tsconfig) → Configuration for the TYPO3 Core Engine (DataHandler)
        - [`mod.web_layout.BackendLayouts`](Configuration/TsConfig/Page/Include/mod.web_layout.BackendLayouts/) → Contains all BackendLayouts
          - [`default.tsconfig`](Configuration/TsConfig/Page/Include/mod.web_layout.BackendLayouts/default.tsconfig) → Contains the default BackendLayout
          - [`example.tsconfig`](Configuration/TsConfig/Page/Include/mod.web_layout.BackendLayouts/example.tsconfig) → Contains and additional example BackendLayout
        - [`mod.wizards.newContentElement.wizardItems`](Configuration/TsConfig/Page/Include/mod.wizards.newContentElement.wizardItems/) → Contains configurations for the newContentElement Wizard
          - [`common.tsconfig`](Configuration/TsConfig/Page/Include/mod.wizards.newContentElement.wizardItems/common.tsconfig) → Defines content elements for the tab `common`
          - [`forms.tsconfig`](Configuration/TsConfig/Page/Include/mod.wizards.newContentElement.wizardItems/forms.tsconfig) → Defines content elements for the tab `forms`
          - [`menu.tsconfig`](Configuration/TsConfig/Page/Include/mod.wizards.newContentElement.wizardItems/menu.tsconfig) → Defines content elements for the tab `menu`
          - [`plugins.tsconfig`](Configuration/TsConfig/Page/Include/mod.wizards.newContentElement.wizardItems/plugins.tsconfig) → Defines content elements for the tab `plugins`
          - [`special.tsconfig`](Configuration/TsConfig/Page/Include/mod.wizards.newContentElement.wizardItems/special.tsconfig) → Defines content elements for the tab `special`
        - [`mod.tsconfig`](Configuration/TsConfig/Page/Include/mod.tsconfig) → Configuration for Backend Modules
        - [`options.tsconfig`](Configuration/TsConfig/Page/Include/options.tsconfig) → Various options for the page affecting the core at various points
        - [`templates.tsconfig`](Configuration/TsConfig/Page/Include/templates.tsconfig) → Override fluid templates rendered by Backend controller
      - [`page.tsconfig`](Configuration/TsConfig/Page/page.tsconfig) → Included by user in page records (includes [`Include`](Configuration/TsConfig/Page/Include/))
    - [`User`](Configuration/TsConfig/User/) → Contains User TSconfig files for backend configuration on a user or group basis
      - [`TCAdefaults.tsconfig`](Configuration/TsConfig/User/TCAdefaults.tsconfig) → Override default values of [`TCA`](Configuration/TCA/) on a user or group basis
      - [`admPanel.tsconfig`](Configuration/TsConfig/User/admPanel.tsconfig) → Configuration of the Admin Panel in the Frontend for the user
      - [`auth.tsconfig`](Configuration/TsConfig/User/auth.tsconfig) → Override default values of [`TCA`](Configuration/TCA/) on a user or group basis
      - [`options.tsconfig`](Configuration/TsConfig/User/options.tsconfig) → Various options for the user affecting the core at various points
      - [`page.tsconfig`](Configuration/TsConfig/User/page.tsconfig) → Override any page TSconfig property on a user or group basis
      - [`permissions.tsconfig`](Configuration/TsConfig/User/permissions.tsconfig) → Set access permissions on a user or group basis
      - [`setup.tsconfig`](Configuration/TsConfig/User/setup.tsconfig) → Default values and override values for the User Settings Module.
  - [`TypoScript`](Configuration/TypoScript/) → TypoScript files from this directory can be included manually
    - [`Constants`](Configuration/TypoScript/Constants/) → TypoScript Constant files
      - [`page.typoscript`](Configuration/TypoScript/Constants/page.typoscript) → Sitepackage constants for page rendering
      - [`plugin`](Configuration/TypoScript/Constants/plugin/) → Contains all TypoScript Constants definitions for the "plugin" top-level object
        - [`tx_seo.typoscript`](Configuration/TypoScript/Constants/plugin/tx_seo.typoscript) → TypoScript Constants for EXT:seo
      - [`plugin.typoscript`](Configuration/TypoScript/Constants/plugin.typoscript) → Constants plugins (includes [`plugin`](Configuration/TypoScript/Setup/plugin/))
      - [`styles.typoscript`](Configuration/TypoScript/Constants/styles.typoscript) → Frontend specific constants (mainly from EXT:fluid_styled_content)
    - [`Setup`](Configuration/TypoScript/Setup/) → TypoScript Setup files
      - [`_GIFBUILDER.typoscript`](Configuration/TypoScript/Setup/_GIFBUILDER.typoscript) → Configure global settings for GIFBUILDER by this top-level object
      - [`config.typoscript`](Configuration/TypoScript/Setup/config.typoscript) → Global configuration for Frontend rendering
      - [`constants.typoscript`](Configuration/TypoScript/Setup/constants.typoscript) → Defines constants for replacement inside a parseFunc
      - [`lib`](Configuration/TypoScript/Setup/lib/) → Contains all TypoScript Setup definitions for the "lib" top-level object
        - [`dynamicContent.typoscript`](Configuration/TypoScript/Setup/lib/dynamicContent.typoscript) → Helper object to dynamically get Content of any Content Column Position
        - [`getIndpEnv.typoscript`](Configuration/TypoScript/Setup/lib/getIndpEnv.typoscript) → Helper object to get Environment-safe server and environment variables
        - [`parseFunc.typoscript`](Configuration/TypoScript/Setup/lib/parseFunc.typoscript) → Helper object to parse content for stuff like special typo tags
      - [`lib.typoscript`](Configuration/TypoScript/Setup/lib.typoscript) → Used for code "libraries" that can be referenced in TypoScript (includes [`lib`](Configuration/TypoScript/Setup/lib/))
      - [`module.typoscript`](Configuration/TypoScript/Setup/module.typoscript) → Backend Module configuration
      - [`page.typoscript`](Configuration/TypoScript/Setup/page.typoscript) → This defines what is rendered in the Frontend
      - [`plugin`](Configuration/TypoScript/Setup/plugin/) → Contains all TypoScript Setup definitions for the "plugin" top-level object
        - [`tx_form.typoscript`](Configuration/TypoScript/Setup/plugin/tx_form.typoscript) → TypoScript Configuration for EXT:form
      - [`plugin.typoscript`](Configuration/TypoScript/Setup/plugin.typoscript) → Frontend set up for plugins (includes [`plugin`](Configuration/TypoScript/Setup/plugin/))
      - [`tt_content`](Configuration/TypoScript/Setup/tt_content/) → Contains all TypoScript Setup definitions for the "tt_content" top-level object
        - [`sitepackage_newcontentelement.typoscript`](Configuration/TypoScript/Setup/tt_content/sitepackage_newcontentelement.typoscript) → Frontend rendering definition for example content element for based on EXT:fluid_styled_content
      - [`tt_content.typoscript`](Configuration/TypoScript/Setup/tt_content.typoscript) → Content rendering definitions (includes [`tt_content`](Configuration/TypoScript/Setup/tt_content/))
    - [`constants.typoscript`](Configuration/TypoScript/constants.typoscript) → Manually added Static TypoScript Constants (includes [`Constants`](Configuration/TypoScript/Constants/))
    - [`setup.typoscript`](Configuration/TypoScript/setup.typoscript) → Manually added Static TypoScript Setup (includes [`Setup`](Configuration/TypoScript/Setup/))
  - [`Yaml`](Configuration/Yaml/) → Any YAML files used to configure this sitepackage
  - [`page.tsconfig`](Configuration/page.tsconfig) → Automatically loaded during build time (includes [`Default`](Configuration/TsConfig/Page/Default/))
- [`Documentation`](Documentation/) → Documentation files for this sitepackage
- [`Initialisation`](Initialisation/) → Data to be used in an empty TYPO3 CMS installation for first initialization
  - [`Site`](Initialisation/Site/) → Site configuration data
    - [`sitepackage`](Initialisation/Site/sitepackage/) → Identifier for the site configuration
      - [`config.yaml`](Initialisation/Site/sitepackage/config.yaml) → YAML configuration of the site configuration
  - [`data.xml`](Initialisation/data.xml) → Data to be used in the database (contains a basic structure for this sitepackage)
- [`LICENSE.txt`](LICENSE.txt) → Official license file for GPL-2.0-or-later
- [`README.md`](README.md) → The file you currently look at
- [`Resources`](Resources/) → Contains any public and private resource files
  - [`Private`](Resources/Private/) → Private resource files like Fluid Templates, Language files or Form Definitions
    - [`.htaccess`](Resources/Private/.htaccess) → Prevents public access to directory [`Private`](Resources/Private/)
    - [`Forms`](Resources/Private/Forms/) → Can contain form definitions (read/write access granted)
      - [`.gitignore`](Resources/Private/Forms/.gitignore) → Ignore all files inside this directory
    - [`Language`](Resources/Private/Language/) → Any language files to provide translated labels in backend and frontend
      - [`de.locallang.xlf`](Resources/Private/Language/de.locallang.xlf) → German translations of Frontend labels
      - [`de.locallang_be.xlf`](Resources/Private/Language/de.locallang_be.xlf) → German translations of Backend labels
      - [`de.locallang_db.xlf`](Resources/Private/Language/de.locallang_db.xlf) → German translations of labels used in [`TCA`](Configuration/TCA/)
      - [`locallang.xlf`](Resources/Private/Language/locallang.xlf) → Source file for Frontend labels (english)
      - [`locallang_be.xlf`](Resources/Private/Language/locallang_be.xlf) → Source file for Backend labels (english)
      - [`locallang_db.xlf`](Resources/Private/Language/locallang_db.xlf) → Source file for labels used in [`TCA`](Configuration/TCA/) (english)
    - [`Layouts`](Resources/Private/Layouts/) → Any Fluid Layout files
      - [`Content`](Resources/Private/Layouts/ContentElements/) → Fluid Layout Overrides for EXT:fluid_styled_content
      - [`Form`](Resources/Private/Layouts/Form/) → Fluid Layout Overrides for EXT:form
        - [`Frontend`](Resources/Private/Layouts/Form/Frontend/) → Fluid Layout Frontend Overrides for EXT:form
      - [`Page`](Resources/Private/Layouts/Page/) → Fluid Layout for [`PAGE`](Configuration/TypoScript/Setup/page.typoscript) rendering of this sitepackage
        - [`Default.html`](Resources/Private/Layouts/Page/Default.html) → Default Frontend layout file
    - [`Partials`](Resources/Private/Partials/) → Any Fluid Partial files
      - [`Content`](Resources/Private/Partials/ContentElements/) → Fluid Partial Overrides for EXT:fluid_styled_content
      - [`Form`](Resources/Private/Partials/Form/) → Fluid Partial Overrides for EXT:form
        - [`Frontend`](Resources/Private/Partials/Form/Frontend/) → Fluid Partial Frontend Overrides for EXT:form
      - [`Page`](Resources/Private/Partials/Page/) → Fluid Partials for [`PAGE`](Configuration/TypoScript/Setup/page.typoscript) rendering of this sitepackage
        - [`Navigation.html`](Resources/Private/Partials/Page/Navigation.html) → Partial for basic navigation rendering
    - [`Templates`](Resources/Private/Templates/) → Any Fluid Template files
      - [`Content`](Resources/Private/Templates/ContentElements/) → Fluid Template Overrides for EXT:fluid_styled_content
        - [`NewContentElement.html`](Resources/Private/Templates/ContentElements/NewContentElement.html) → Fluid Template for example content element
      - [`Form`](Resources/Private/Templates/Form/) → Fluid Template Overrides for EXT:form
        - [`Frontend`](Resources/Private/Templates/Form/Frontend/) → Fluid Template Frontend Overrides for EXT:form
      - [`Page`](Resources/Private/Templates/Page/) → Fluid Templates for [`PAGE`](Configuration/TypoScript/Setup/page.typoscript) rendering of this sitepackage
        - [`Default.html`](Resources/Private/Templates/Page/Default.html) → Template File for default layout (configured in /Configuration/TsConfig/Page/Default/mod.tsconfig)
        - [`Example.html`](Resources/Private/Templates/Page/Example.html) → Template File for example layout (configured in /Configuration/TsConfig/Page/Include/mod.tsconfig)
  - [`Public`](Resources/Public/) → Public resource files accessible by the browser (e.g. CSS, JavaScript, Images, etc.)
    - [`Css`](Resources/Public/Css/) → Any CSS files to be loaded by the sitepackage
      - [`Backend`](Resources/Public/Css/Backend/) → Backend CSS files to be loaded by the sitepackage (compiled and minified by Gulp)
        - [`...`](Resources/Public/Css/Backend/) → Compiled Backend CSS files
      - [`Frontend`](Resources/Public/Css/Frontend/) → Frontend CSS files to be loaded by the sitepackage (compiled and minified by Gulp)
        - [`...`](Resources/Public/Css/Frontend/) → Compiled Frontend CSS files
    - [`Fonts`](Resources/Public/Fonts/) → Any Font files to be loaded by the sitepackage
    - [`Icons`](Resources/Public/Icons/) → Any Icon files to be loaded by the sitepackage
      - [`BackendLayouts`](Resources/Public/Icons/BackendLayouts) → Contains Icons for BackendLayouts
        - [`columns-2.svg`](Resources/Public/Icons/BackendLayouts/columns-2.svg) → Example BackendLayout Icon file to display two columns
        - [`default.svg`](Resources/Public/Icons/BackendLayouts/default.svg) → Default BackendLayout Icon file to display one column
      - [`Favicon`](Resources/Public/Icons/Favicon) → Contains Cross Browser Favicon Icons
        - [`...`](Resources/Public/Icons/Favicon) → Resources created by [RealFaviconGenerator](https://realfavicongenerator.net/) [v0.16](https://realfavicongenerator.net/change_log#v0.16)
      - [`Extension.svg`](Resources/Public/Icons/Extension.svg) → Extension icon
    - [`Images`](Resources/Public/Images/) → Any Image files to be loaded by the sitepackage
      - [`Backend`](Resources/Public/Images/Backend/) → Contains Images that are used in the backend
        - [`loginBackgroundImage.svg`](Resources/Public/Images/Backend/loginBackgroundImage.svg) → Login Background Image configured in [`ext_localconf.php`](ext_localconf.php)
      - [`Distribution.png`](Resources/Public/Images/Distribution.png) → Preview image for the distribution list in the Extension Manager
      - [`DistributionWelcome.png`](Resources/Public/Images/DistributionWelcome.png) → The welcome image is displayed in the distribution detail view inside the Extension Manager.
    - [`JavaScript`](Resources/Public/JavaScript/) → Any JavaScript files to be loaded by the sitepackage
      - [`Dist`](Resources/Public/JavaScript/Dist/) → Contains minified redistributable JavaScript files (compiled by Gulp)
        - [`...`](Resources/Public/JavaScript/Dist/) → Compiled JavaScript files
      - [`Src`](Resources/Public/JavaScript/Src/) → Contains source JavaScript files (used by Gulp)
        - [`main.js`](Resources/Public/JavaScript/Src/main.js) → A starting point to write your own JavaScript (this should be compiled by Gulp)
    - [`Scss`](Resources/Public/Scss/) → Any SCSS files to be compiled to CSS files
      - [`Backend`](Resources/Public/Scss/Backend/) → Backend SCSS files to be compiled by Gulp
        - [`rte.scss`](Resources/Public/Scss/Backend/rte.scss) → Backend RTE styles that inherit frontend RTE styles
      - [`Frontend`](Resources/Public/Scss/Frontend/) → Frontend SCSS files to be compiled by Gulp
        - [`_rte.scss`](Resources/Public/Scss/Frontend/_rte.scss) → Frontend RTE styles (prepending "_" means, that this file will be included by other files and compiled by itself)
        - [`_variables.scss`](Resources/Public/Scss/Frontend/_variables.scss) → Global variables to be used in all scss files (prepending "_" means, that this file will be included by other files and compiled by itself)
        - [`main.scss`](Resources/Public/Scss/Frontend/main.scss) → Main styles (imports [`_rte.scss`](Resources/Public/Scss/Frontend/_rte.scss) and [`_variables.scss`](Resources/Public/Scss/Frontend/_variables.scss))
        - [`main-color1.scss`](Resources/Public/Scss/Frontend/main-color1.scss) → Main styles with definitions for color scheme 1 (imports [`main.scss`](Resources/Public/Scss/Frontend/main.scss))
        - [`main-color2.scss`](Resources/Public/Scss/Frontend/main-color1.scss) → Main styles with definitions for color scheme 2 (imports [`main.scss`](Resources/Public/Scss/Frontend/main.scss))
- [`Tests`](Tests/) → This directory contains tests, e.g. unit tests in the subfolder [`Unit`](Tests/Unit/)
  - [`Functional`](Tests/Functional/) → 
    - [`Domain`](Tests/Functional/Domain/) → 
      - [`Repository`](Tests/Functional/Domain/Repository/) → 
        - [`Fixtures`](Tests/Functional/Domain/Repository/Fixtures/) → 
  - [`Unit`](Tests/Unit/) → 
    - [`Controller`](Tests/Unit/Controller/) → 
    - [`Domain`](Tests/Unit/Domain/) → 
      - [`Model`](Tests/Unit/Domain/Model/) → 
      - [`Repository`](Tests/Unit/Domain/Repository/) → 
- [`.gitignore`](.gitignore) → Exclude any unnecessary/temporary data from versioning
- [`.jshintrc`](.gitignore) → Basis JSHint configuration file used by Gulp ([JSHint Documentation](https://jshint.com/docs/))
- [`composer.json`](composer.json) → Registration file for composer based installations
- [`ext_conf_template.txt`](ext_conf_template.txt) → Extension Configuration that will be accessible in the TYPO3 backend from Settings module
- [`ext_emconf.php`](ext_emconf.php) → Registration file for legacy installations
- [`ext_localconf.php`](ext_localconf.php) → Always included in global scope, in Frontend, Backend and CLI context
- [`ext_tables.php`](ext_tables.php) → Register Backend Modules / scheduler tasks, add table options, $GLOBALS assignments, BE User settings extensions
- [`ext_tables.sql`](ext_tables.sql) → Table-structure dump of tables used by the sitepackage
- [`ext_tables_static+adt.sql`](ext_tables_static+adt.sql) → Static SQL data to be used by the sitepackage
- [`ext_typoscript_constants.typoscript`](ext_typoscript_constants.typoscript) → Default TypoScript constants that will be included in all templates
- [`ext_typoscript_setup.typoscript`](ext_typoscript_setup.typoscript) → Default TypoScript setup that will be included in all templates
- [`gulpfile.js`](gulpfile.js) → Gulp Task Runner Configuration file, after initial `npm install` run `gulp` for all tasks or `gulp --tasks` for an overview
- [`LICENSE.txt`](LICENSE.txt) → Official GNU general public license file
- [`package.json`](package.json) → Node Package Manager (npm) to set up Gulp Tasks, for first initialization run `npm install`

## FAQ:

### How to get rid of the README.md files?

If you get disturbed by the README.md files in your current project, run the following command inside the sitepackage root to delete them:

```
find ./packages/sitepackage/ -name "README.md" -type f -delete
```

or in DDEV:

```
ddev exec find ./packages/sitepackage/ -name "README.md" -type f -delete
```

### How do I easily change the namespace, composer name and extension key?

If you want to change the Namespace used in all files from `VendorName/Sitepackage` to `FancyCompany/GreatExtension` (adjust this example to your needs) use the following commands:

```
find ./packages/sitepackage \( -iname \*.html \) -type f -print0 | xargs -0 sed -i 's/VendorName\/Sitepackage/FancyCompany\/GreatExtension/g'
find ./packages/sitepackage \( -iname \*.php -o -iname \*.yaml \) -type f -print0 | xargs -0 sed -i 's/VendorName\\\Sitepackage/FancyCompany\\\GreatExtension/g'
find ./packages/sitepackage \( -iname \*.php -o -iname \*.json \) -type f -print0 | xargs -0 sed -i 's/VendorName\\\\\\\Sitepackage/FancyCompany\\\\\\\GreatExtension/g'
```

To change the composer name and extension key use the following commands:

```
find ./packages/sitepackage \( -iname \*.json \) -type f -print0 | xargs -0 sed -i 's/vendorname\/sitepackage/fancy-company\/great-extension/g'
find ./packages/sitepackage \( -iname \*.php -o -iname \*.xml -o -iname \*.yaml -o -iname \*.typoscript -o -iname \*.tsconfig -o -iname \*.xlf -o -iname \*.json \) -type f -print0 | xargs -0 sed -i 's/sitepackage/great-extension/g'
mv ./packages/sitepackage ./packages/great-extension
```

or in DDEV:

```
ddev exec "find ./packages/sitepackage \( -iname \*.html \) -type f -print0 | xargs -0 sed -i 's/VendorName\/Sitepackage/FancyCompany\/GreatExtension/g'"
ddev exec "find ./packages/sitepackage \( -iname \*.php -o -iname \*.yaml \) -type f -print0 | xargs -0 sed -i 's/VendorName\\\Sitepackage/FancyCompany\\\GreatExtension/g'"
ddev exec "find ./packages/sitepackage \( -iname \*.php -o -iname \*.json \) -type f -print0 | xargs -0 sed -i 's/VendorName\\\\\\\Sitepackage/FancyCompany\\\\\\\GreatExtension/g'"
```

```
ddev exec "find ./packages/sitepackage \( -iname \*.json \) -type f -print0 | xargs -0 sed -i 's/vendorname\/sitepackage/fancy-company\/great-extension/g'"
ddev exec "find ./packages/sitepackage \( -iname \*.php -o -iname \*.xml -o -iname \*.yaml -o -iname \*.typoscript -o -iname \*.tsconfig -o -iname \*.xlf -o -iname \*.json \) -type f -print0 | xargs -0 sed -i 's/sitepackage/great-extension/g'"
ddev exec mv ./packages/sitepackage ./packages/great-extension
```

© 2022 Eric Bode
