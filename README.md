# <img width="50" height="50" src="Resources/Public/Icons/Extension.svg" alt="TYPO3 CMS Sitepackage"> TYPO3 CMS Sitepackage</div>

This sitepackage sticks as closely as possible to the recommended standard and maps all conceivable functional areas. There are also various examples of common use cases.

For more details there is a documentation link in the comments of each file.

## Features

### Full blown directory and file structure

This sitepackage contains almost all the directories and files (except resource files) you need when creating your own sitepackage.

### Usage of a Site Set

In order to achieve a clear separation of the sitepackage configurations between the sites of a TYPO3 instance, this sitepackage uses all elementary components via its own Site Set since v13.

### Color scheme selector

As an example of how to add new fields to pages records through `ext_tables.sql` and `/Configuration/TCA/Overrides/pages.php` and how to implement custom Symfony Conditions (with files `Configuration/ExpressionLanguage.php`, `Classes/ExpressionLanguage/CustomTypoScriptConditionProvider.php` and `Classes/ExpressionLanguage/FunctionsProvider/CustomConditionFunctionsProvider.php`) to be used in the TypoScript/TSconfig context (`Configuration/Sets/Sitepackage/Setup/page.typoscript`) this sitepackage contains a method to provide choosable color schemes to backend users.

### Backend Style Customization

This sitepackage can customize the TYPO3 login mask style (background image, footnote, highlight color, login logo and login logos alt text) and the backend style (backend favicon and logo). It uses the function of `EXT:backend`. But instead of relying on a backend user to set these variables through the extension settings it overrides them in `ext_localconf.php` with the Extension Configuration of this sitepackage in `ext_conf_template.txt` (which is an easier and centralized way).

### Example Backend Layouts

Example BackendLayouts can be found here `Configuration/Sets/Sitepackage/PageTsConfig/mod.web_layout.BackendLayouts/` (as part of the Site Set TSconfig).

### Example Custom Content Element

This sitepackage contains an example of a custom content element based on the [extension “Content Blocks”](https://extensions.typo3.org/extension/content_blocks), which will be integrated into the core in the future.

The required TCA, database updates and registration in the “New Content Element Wizard” are handled by Content Blocks automatically based on a YAML configuration (Example: `ContentBlocks/ContentElements/newcontentelement/config.yaml`).

This sitepackage additionally provides a new Content Blocks [Basic](https://docs.typo3.org/p/friendsoftypo3/content-blocks/main/en-us/YamlReference/Basics/Index.html#basics) `TYPO3/Headers` (note the plural spelling) for the output of the header**s** palette including the fields `date`, `header_link` and `subheader`, which are not included in the Standard Basic `TYPO3/Header`.

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

The Site Set of `EXT:seo` is a dependency of the sitepackage Site Set. The sitepackage adds the ability to hide pages in the XML sitemap by setting the sitemap priority to 0. This is done with an appropriate setting in `Configuration/Sets/Sitepackage/settings.yaml`.

Please make sure to add the following lines to your site configuration to be able to access the sitemap via its human-readable URI `sitemap.xml` if you have not used this sitepackage as a distribution:

```
routeEnhancers:
  PageTypeSuffix:
    type: PageType
    map:
      sitemap.xml: 1533906435
```

### Cross Browser Favicons and App Icons

Based on resources of [RealFaviconGenerator](https://realfavicongenerator.net/) [v0.16](https://realfavicongenerator.net/change_log#v0.16) the sitepackage includes all recommended cross browser definitions for Favicons / App Icons. The sitepackage adds all html header information in file `Configuration/Sets/Sitepackage/Setup/page.typoscript`.

The file `Configuration/Sets/Sitepackage/Setup/site.webmanifest.typoscript` configures a separete PAGE object with mime type `application/json` to output the `site.webmanifest`.

To be able to also display `site.webmanifest` you need to add the following lines in your site configuration if you have not used this sitepackage as a distribution:

```
routeEnhancers:
  PageTypeSuffix:
    type: PageType
    map:
      # The above-mentioned configuration for "sitemap.xml" may already be here.
      site.webmanifest: 3478304621
```

**Note:** Since all resources are referenced with paths generated by TYPO3, this solution is compatible with the future changeover by `typo3/cms-composer-installers:4.0`. [Here](https://b13.com/core-insights/typo3-and-composer-weve-come-a-long-way) you can get further information about the changes.

You can read more about the integration of app icons in TYPO3 [here](https://gist.github.com/ErHaWeb/284b5168554dfb3ee734ec0998d80238).

### Site Configuration Auto Initialization

If you install this sitepackage in an empty TYPO3 CMS installation it will create a new site configuration with configuration for `sitemap.xml` and `site.webmanifest`, a first root page with a link to the static TSconfig of this sitepackage, a template record with a link to the static TypoScript of this sitepackage and pages records for various HTTP error codes (404, 403, 500, 503 and undefined), which are referenced in the site configuration.

By default the language en-US is used. If you want to change it, just edit the site configuration in your TYPO3 installation under `config/sites/sitepackage/config.yaml`or via the `Site Management > Sites` module in the TYPO3 backend.

### Ready to use Task Runner for SCSS and JavaScript

This site package provides a [Gulp](https://gulpjs.com/) task runner that handles the following tasks:

- Compile SCSS from `Resources/Public/Scss/` to CSS directory `Resources/Public/Css/`
- Improve backwards compatibility of your CSS code by using the well known [Autoprefixer PostCSS plugin](https://github.com/postcss/autoprefixer)
- Minify JavaScript and CSS files and save them as separate files with ending `*.min.css` / `*.min.js`
- Static JavaScript code analysis with ([JSHint Documentation](https://jshint.com/docs/)), feel free to adjust the configuration file `.jshintrc` to your needs
- Concatenate and minify all JavaScript files from directory `Resources/Public/JavaScript/Src` and save the result under `Resources/Public/JavaScript/Dist`

To initially install Gulp and all necessary modules execute command `npm install`. Now you are able to run all tasks at once by executing command `gulp`. To run specific tasks use `gulp <taskname>`. To get an overview wich tasks can be executed run `gulp --tasks`.

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

© 2024 Eric Harrer
