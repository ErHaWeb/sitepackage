# Sitepackage Basic Structure
```
.
├── Classes                                     
│   ├── Controller                              
│   │   └── .gitkeep                          # Placeholder file to track directory
│   ├── Domain                                  
│   │   ├── Model                               
│   │   │   └── .gitkeep                      # Placeholder file to track directory
│   │   └── Repository                          
│   │       └── .gitkeep                      # Placeholder file to track directory
│   └── ViewHelpers                             
│       └── HtmlTagAttributesViewHelper.php   # Example ViewHelper file to add HTML tag attributes
├── Configuration                               
│   ├── Backend                                 
│   │   ├── AjaxRoutes.php                    # Definitions for ajax routes for entry points
│   │   ├── Modules.php                       # Definitions for modules
│   │   └── Routes.php                        # Definitions for "regular" routes for entry points
│   ├── Extbase                                 
│   │   └── Persistence                         
│   │       └── Classes.php                   # Extbase persistence mapping for classes
│   ├── FlexForms                               
│   │   └── FlexFormExample.xml               # Example FlexForm file to provide plugin settings
│   ├── Form                                    
│   │   └── CustomFormSetup.yaml              # Customize form configuration
│   ├── Icons.php                             # Registers custom Icons in the IconRegistry
│   ├── RTE                                     
│   │   └── RteConfig.yaml                    # Customize RTE configuration
│   ├── RequestMiddlewares.php                # Middleware Configuration for frontend and backend
│   ├── Services.yaml                         # Configuration for automatic Symfony Service loading
│   ├── TCA                                     
│   │   └── Overrides                           
│   │       ├── pages.php                     # Override "pages" TCA (e.g. add Page TSconfig includes)
│   │       ├── sys_template.php              # Override "sys_template" TCA (e.g. add TypoScript templates)
│   │       └── tt_content.php                # Override "tt_content" TCA (e.g. prepare custom content elements)
│   ├── TsConfig                                
│   │   ├── Page                                
│   │   │   ├── Default                       # Page TSconfig from "./Default" directory is always used
│   │   │   │   ├── RTE.tsconfig              # Customize RTE configuration
│   │   │   │   ├── TCAdefaults.tsconfig      # Override default values of TCA
│   │   │   │   ├── TCEFORM.tsconfig          # Detailed configuration of how editing forms are rendered
│   │   │   │   ├── TCEMAIN.tsconfig          # Configuration for the TYPO3 Core Engine (DataHandler)
│   │   │   │   ├── mod.tsconfig              # Configuration for backend modules
│   │   │   │   ├── options.tsconfig          # Various options for the page affecting the core at various points
│   │   │   │   └── templates.tsconfig        # Override fluid templates rendered by backend controller
│   │   │   ├── Include                       # Page TSconfig from "./Include" directory cann be selected for pages
│   │   │   │   ├── RTE.tsconfig              # Look at ../Default/RTE.tsconfig
│   │   │   │   ├── TCAdefaults.tsconfig      # Look at ../Default/TCAdefaults.tsconfig
│   │   │   │   ├── TCEFORM.tsconfig          # Look at ../Default/TCEFORM.tsconfig
│   │   │   │   ├── TCEMAIN.tsconfig          # Look at ../Default/TCEMAIN.tsconfig
│   │   │   │   ├── mod.tsconfig              # Look at ../Default/mod.tsconfig
│   │   │   │   ├── options.tsconfig          # Look at ../Default/options.tsconfig
│   │   │   │   └── templates.tsconfig        # Look at ../Default/templates.tsconfig
│   │   │   └── page.tsconfig                 # Includes any file "./Include" (Added by ../../TCA/Overrides/pages.php)
│   │   └── User                                
│   │       ├── TCAdefaults.tsconfig          # 
│   │       ├── admPanel.tsconfig             # Configuration of the Admin Panel in the Frontend for the user
│   │       ├── auth.tsconfig                 # Override default values of TCA on a user or group basis
│   │       ├── options.tsconfig              # Various options for the user affecting the core at various points
│   │       ├── page.tsconfig                 # Override any page TSconfig property on a user or group basis
│   │       ├── permissions.tsconfig          # Set access permissions on a user or group basis
│   │       └── setup.tsconfig                # Default values and override values for the User Settings module.
│   ├── TypoScript                              
│   │   ├── Constants                           
│   │   │   ├── page.typoscript               # Sitepackage constants for page rendering
│   │   │   ├── plugin.typoscript             # Override plugin specific constants
│   │   │   └── styles.typoscript             # Frontend specific constants (mainly from EXT:fluid_styled_content)
│   │   └── Setup                               
│   │       ├── _GIFBUILDER.typoscript        # Configure global settings for GIFBUILDER by this top-level object
│   │       ├── config.typoscript             # Global configuration for frontend rendering
│   │       ├── constants.typoscript          # Defines constants for replacement inside a parseFunc
│   │       ├── lib.typoscript                # Used for code "libraries" that can be referenced in TypoScript
│   │       ├── module.typoscript             # Backend module configuration
│   │       ├── page.typoscript               # This defines what is rendered in the frontend
│   │       ├── plugin.typoscript             # Frontend set up for plugins
│   │       └── tt_content.typoscript         # Content rendering definitions
│   ├── Yaml                                    
│   │   └── .gitkeep                          # Placeholder file to track directory
│   └── page.tsconfig                         # Automatically loaded during build time (includes ./TsConfig/Page/Default)
├── Documentation                               
│   └── .gitkeep                              # Placeholder file to track directory
├── LICENSE.txt                               # Official license file for GPL-2.0-or-later
├── README.md                                 # The file you currently look at
├── Resources                                   
│   ├── Private                                 
│   │   ├── Forms                             # Can contain form definitions (read/write access granted)
│   │   │   ├── .gitignore                    # Ignore all files inside this directory
│   │   ├── Language                            
│   │   │   ├── de.locallang.xlf              # German translations of frontend labels
│   │   │   ├── de.locallang_db.xlf           # German translations of backend labels
│   │   │   ├── locallang.xlf                 # Source file for frontend labels (english)
│   │   │   └── locallang_db.xlf              # Source file for backend labels (english)
│   │   ├── Layouts                             
│   │   │   ├── Form                            
│   │   │   │   └── Frontend                    
│   │   │   │       └── .gitkeep              # Placeholder file to track directory
│   │   │   └── Page                            
│   │   │       └── Default.html              # Default frontend layout file
│   │   ├── Partials                            
│   │   │   ├── Form                            
│   │   │   │   └── Frontend                    
│   │   │   │       └── .gitkeep              # Placeholder file to track directory
│   │   │   └── Page                            
│   │   │       └── Navigation.html           # Partial for basic navigation rendering
│   │   └── Templates                           
│   │       ├── Form                            
│   │       │   └── Frontend                    
│   │       │       └── .gitkeep              # Placeholder file to track directory
│   │       └── Page                            
│   │           ├── Default.html              # Template File for default layout (configured in /Configuration/TsConfig/Page/Default/mod.tsconfig)
│   │           └── Example.html              # Template File for example layout (configured in /Configuration/TsConfig/Page/Include/mod.tsconfig)
│   └── Public                                  
│       ├── Css                                 
│       │   ├── main.css                      # Main frontend CSS file (should be compiled from ../Scss/main.scss)
│       │   └── rte.css                       # CSS used inside the Rich Text Editor (should be compiled from ../Scss/rte.scss)
│       ├── Fonts                               
│       │   └── .gitkeep                      # Placeholder file to track directory
│       ├── Icons                               
│       │   └── Extension.svg                 # Extension icon
│       ├── Images                              
│       │   └── .gitkeep                      # Placeholder file to track directory
│       ├── JavaScript                          
│       │   ├── .gitkeep                      # Placeholder file to track directory
│       │   └── main.js                       # Main JavaScript file
│       └── Scss                                
│           ├── main.scss                     # Main SCSS source file for frontend CSS
│           └── rte.scss                      # SCSS source file for Rich Text Editor CSS
├── Tests                                       
│   └── .gitkeep                              # Placeholder file to track directory
├── composer.json                             # Registration file for composer based installations
├── ext_emconf.php                            # Registration file for legacy installations
├── ext_localconf.php                         # Always included in global scope, in frontend, backend and CLI context
├── ext_tables.php                            # Register backend modules / scheduler tasks, add table options, $GLOBALS assignments, BE User settings extensions
├── ext_tables.sql                            # Table-structure dump of tables used by the sitepackage
├── ext_tables_static+adt.sql                 # Static SQL data to be used by the sitepackage
├── ext_typoscript_constants.typoscript       # Default TypoScript constants that will be included in all templates
└── ext_typoscript_setup.typoscript           # Default TypoScript setup that will be included in all templates
```
**Notice:** You will find a documentation link in each file for more details.