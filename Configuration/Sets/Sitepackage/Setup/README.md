# Configuration/Sets/Sitepackage/Setup/

Site-specific TypoScript Setup files

> Note that @import statements are still fine to be used for **local includes**, but should be **avoided for cross-set/extensions dependencies** because sets are automatically ordered and deduplicated. This means that TypoScript is not loaded multiple times if a common dependency of multiple sets is required.