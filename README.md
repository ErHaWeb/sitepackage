# Sitepackage Basic Structure

```
.
├── Classes                                   # Contains all PHP Classes
│   ├── Controller                            # Contains all PHP controller Classes
│   ├── Domain                                # Contains all PHP Domain Classes
│   │   ├── Model                             # Contains all PHP Domain Model Classes
│   │   ├── Persistence                       # Contains all PHP Domain Persistence Classes
│   │   ├── Repository                        # Contains all PHP Domain Repository Classes
│   │   └── Validator                         # Contains all PHP Domain Validator Classes
│   ├── Service                               # Contains all PHP Service Classes
│   ├── View                                  # Contains all PHP View Classes
│   └── ViewHelpers                           # Contains all PHP ViewHelper Classes to be used in Fluid
│       └── HtmlTagAttributesViewHelper.php   # Example ViewHelper file to add HTML tag attributes
├── Configuration                             # Contains any configuration file for Backend and Frontend
│   ├── Backend                               # Contains configuration that is important within the Backend
│   │   ├── AjaxRoutes.php                    # Definitions for ajax routes for entry points
│   │   ├── Modules.php                       # Definitions for Modules
│   │   └── Routes.php                        # Definitions for "regular" routes for entry points
│   ├── Extbase                               # Contains folder "Persistence"
│   │   └── Persistence                       # Contains PHP file "Classes"
│   │       └── Classes.php                   # Extbase persistence mapping for Classes
│   ├── FlexForms                             # Contains FlexForm XML files
│   │   └── FlexFormExample.xml               # Example FlexForm file to provide plugin settings
│   ├── Form                                  # Contains YAML files for form customization
│   │   └── CustomFormSetup.yaml              # Customize form configuration
│   ├── Icons.php                             # Registers custom Icons in the IconRegistry
│   ├── RTE                                   # Contains YAML files for RTE customization
│   │   └── RteConfig.yaml                    # Customize RTE configuration
│   ├── RequestMiddlewares.php                # Middleware Configuration for Frontend and Backend
│   ├── Services.yaml                         # Configuration for automatic Symfony Service loading
│   ├── TCA                                   # Contains Table Configuration Array PHP files and Overrides
│   │   └── Overrides                         # Contains TCA Override PHP files
│   │       ├── pages.php                     # Override "pages" TCA (e.g. add Page TSconfig includes)
│   │       ├── sys_template.php              # Override "sys_template" TCA (e.g. add TypoScript templates)
│   │       └── tt_content.php                # Override "tt_content" TCA (e.g. prepare custom content elements)
│   ├── TsConfig                              # Any TSconfig file for backend related adjustments
│   │   ├── Page                              # Contains Page TSconfig files for backend configuration (primarily modules)
│   │   │   ├── Default                       # Page TSconfig from "./Default" directory is always included
│   │   │   │   ├── RTE.tsconfig              # Customize RTE configuration
│   │   │   │   ├── TCAdefaults.tsconfig      # Override default values of TCA
│   │   │   │   ├── TCEFORM.tsconfig          # Detailed configuration of how editing forms are rendered
│   │   │   │   ├── TCEMAIN.tsconfig          # Configuration for the TYPO3 Core Engine (DataHandler)
│   │   │   │   ├── mod.tsconfig              # Configuration for Backend Modules
│   │   │   │   ├── options.tsconfig          # Various options for the page affecting the core at various points
│   │   │   │   └── templates.tsconfig        # Override fluid templates rendered by Backend controller
│   │   │   ├── Include                       # Page TSconfig from "./Include" directory can be included manually
│   │   │   │   ├── RTE.tsconfig              # Look at ../Default/RTE.tsconfig
│   │   │   │   ├── TCAdefaults.tsconfig      # Look at ../Default/TCAdefaults.tsconfig
│   │   │   │   ├── TCEFORM.tsconfig          # Look at ../Default/TCEFORM.tsconfig
│   │   │   │   ├── TCEMAIN.tsconfig          # Look at ../Default/TCEMAIN.tsconfig
│   │   │   │   ├── mod.tsconfig              # Look at ../Default/mod.tsconfig
│   │   │   │   ├── options.tsconfig          # Look at ../Default/options.tsconfig
│   │   │   │   └── templates.tsconfig        # Look at ../Default/templates.tsconfig
│   │   │   └── page.tsconfig                 # Included by user in page records (includes ./TsConfig/Page/Include)
│   │   └── User                              # Contains User TSconfig files for backend configuration on a user or group basis
│   │       ├── TCAdefaults.tsconfig          # Override default values of TCA on a user or group basis
│   │       ├── admPanel.tsconfig             # Configuration of the Admin Panel in the Frontend for the user
│   │       ├── auth.tsconfig                 # Override default values of TCA on a user or group basis
│   │       ├── options.tsconfig              # Various options for the user affecting the core at various points
│   │       ├── page.tsconfig                 # Override any page TSconfig property on a user or group basis
│   │       ├── permissions.tsconfig          # Set access permissions on a user or group basis
│   │       └── setup.tsconfig                # Default values and override values for the User Settings Module.
│   ├── TypoScript                            # TypoScript files from this directory can be included manually
│   │   ├── Constants                         # TypoScript Constant files
│   │   │   ├── page.typoscript               # Sitepackage constants for page rendering
│   │   │   ├── plugin.typoscript             # Override plugin specific constants
│   │   │   └── styles.typoscript             # Frontend specific constants (mainly from EXT:fluid_styled_content)
│   │   ├── Setup                             # TypoScript Setup files
│   │   │   ├── _GIFBUILDER.typoscript        # Configure global settings for GIFBUILDER by this top-level object
│   │   │   ├── config.typoscript             # Global configuration for Frontend rendering
│   │   │   ├── constants.typoscript          # Defines constants for replacement inside a parseFunc
│   │   │   ├── lib.typoscript                # Used for code "libraries" that can be referenced in TypoScript
│   │   │   ├── module.typoscript             # Backend Module configuration
│   │   │   ├── page.typoscript               # This defines what is rendered in the Frontend
│   │   │   ├── plugin.typoscript             # Frontend set up for plugins
│   │   │   └── tt_content.typoscript         # Content rendering definitions
│   │   ├── constants.typoscript              # Manually added Static TypoScript Constants (includes ./Constants)
│   │   └── setup.typoscript                  # Manually added Static TypoScript Setup (includes ./Setup)
│   ├── Yaml                                  # Any YAML files used to configure this sitepackage
│   └── page.tsconfig                         # Automatically loaded during build time (includes ./TsConfig/Page/Default)
├── Documentation                             # Documentation files for this sitepackage
├── LICENSE.txt                               # Official license file for GPL-2.0-or-later
├── README.md                                 # The file you currently look at
├── Resources                                 # Contains any public and private resource files
│   ├── Private                               # Private resource files like Fluid Templates, Language files or Form Definitions 
│   │   ├── Forms                             # Can contain form definitions (read/write access granted)
│   │   │   ├── .gitignore                    # Ignore all files inside this directory
│   │   ├── Language                          # Any language files to provide translated labels in backend and frontend 
│   │   │   ├── de.locallang.xlf              # German translations of Frontend labels
│   │   │   ├── de.locallang_db.xlf           # German translations of Backend labels
│   │   │   ├── locallang.xlf                 # Source file for Frontend labels (english)
│   │   │   └── locallang_db.xlf              # Source file for Backend labels (english)
│   │   ├── Layouts                           # Any Fluid Layout files
│   │   │   ├── Form                          # Fluid Layout Overrides for EXT:form
│   │   │   │   └── Frontend                  # Fluid Layout Frontend Overrides for EXT:form
│   │   │   └── Page                          # Fluid Layout for PAGE rendering of this sitepackage
│   │   │       └── Default.html              # Default Frontend layout file
│   │   ├── Partials                          # Any Fluid Partial files
│   │   │   ├── Form                          # Fluid Partial Overrides for EXT:form
│   │   │   │   └── Frontend                  # Fluid Partial Frontend Overrides for EXT:form
│   │   │   └── Page                          # Fluid Partials for PAGE rendering of this sitepackage
│   │   │       └── Navigation.html           # Partial for basic navigation rendering
│   │   └── Templates                         # Any Fluid Template files
│   │       ├── Form                          # Fluid Template Overrides for EXT:form
│   │       │   └── Frontend                  # Fluid Template Frontend Overrides for EXT:form
│   │       └── Page                          # Fluid Templates for PAGE rendering of this sitepackage
│   │           ├── Default.html              # Template File for default layout (configured in /Configuration/TsConfig/Page/Default/mod.tsconfig)
│   │           └── Example.html              # Template File for example layout (configured in /Configuration/TsConfig/Page/Include/mod.tsconfig)
│   └── Public                                # Public resource files accessible by the browser (e.g. CSS, JavaScript, Images, etc.)
│       ├── Css                               # Any CSS files to be loaded by the sitepackage
│       │   ├── main.css                      # Main Frontend CSS file (should be compiled from ../Scss/main.scss)
│       │   └── rte.css                       # CSS used inside the Rich Text Editor (should be compiled from ../Scss/rte.scss)
│       ├── Fonts                             # Any Font files to be loaded by the sitepackage
│       ├── Icons                             # Any Icon files to be loaded by the sitepackage
│       │   └── Extension.svg                 # Extension icon
│       ├── Images                            # Any Image files to be loaded by the sitepackage
│       ├── JavaScript                        # Any JavaScript files to be loaded by the sitepackage
│       │   └── main.js                       # Main JavaScript file
│       └── Scss                              # Any SCSS files to be compiled to CSS files
│           ├── main.scss                     # Main SCSS source file for Frontend CSS
│           └── rte.scss                      # SCSS source file for Rich Text Editor CSS
├── Tests                                     # This directory contains tests, e.g. unit tests in the subfolder Unit/.
│   ├── Functional                            # 
│   │   └── Domain                            # 
│   │       └── Repository                    #
│   │           └── Fixtures                  # 
│   └── Unit                                  #
│       ├── Controller                        #
│       └── Domain                            #
│           ├── Model                         #
│           └── Repository                    # 
├── composer.json                             # Registration file for composer based installations
├── ext_emconf.php                            # Registration file for legacy installations
├── ext_localconf.php                         # Always included in global scope, in Frontend, Backend and CLI context
├── ext_tables.php                            # Register Backend Modules / scheduler tasks, add table options, $GLOBALS assignments, BE User settings extensions
├── ext_tables.sql                            # Table-structure dump of tables used by the sitepackage
├── ext_tables_static+adt.sql                 # Static SQL data to be used by the sitepackage
├── ext_typoscript_constants.typoscript       # Default TypoScript constants that will be included in all templates
└── ext_typoscript_setup.typoscript           # Default TypoScript setup that will be included in all templates
```

## Notices:

### Documentation Links

You will find a documentation link in each file for more details.

### How to get rid of the README.md files?

If you get disturbed by the README.md files in your current project, run the following command inside the sitepackage root to delete them:

```
find ./packages/sitepackage/ -name "README.md" -type f -delete
```

or

```
ddev exec find ./packages/sitepackage/ -name "README.md" -type f -delete
```

if you are in a local DDEV environment.
