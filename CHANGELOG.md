# Changelog
All notable changes to **markItUp!** will be documented in this file.

The format is based on [Keep a Changelog](http://keepachangelog.com/en/1.0.0/).

## [Unreleased]

### Changed

- Changelog is now based on [Keep a Changelog](http://keepachangelog.com/en/1.0.0/)

### Fixed

- Fixed invalid meta in bower.json

## [1.1.15] - 2018-08-16

### Added

- Allow Custom tags to button name
- Added HTTP method config for AJAX preview request
- Added support for jQuery 2 and 3
- Added MIT license
- Added bower.json

### Changed

- markItUpRemove function is now idempotent 

### Fixed

- avoid global namespace pollution
- Never use empty href in links

## [1.1.14] - 2013-02-04

### Changed

- Compatibility patch for jQuery 1.9+
- Click on menu bubbles up so it could be reused (michilehr)

### Fixed

- Fixed default selection after using a tag having either openBlockWith or closeBlockWith (r3c)

## [1.1.13] - 2012-08-30

### Added

- Added ability to render preview in a DOM element (ytjohn & jaysalvat)
- Added the previewHandler option to allow complete control over preview (lecterror)
- Added `$(elm).markItUp('insert', { })` and `$(elm).markItUp('remove');`
- Added package.json

### Changed

- Updated events to use namespace (JoyceBabu)
- Updated the demo

### Fixed

- Fixed Ctrl+Enter syntax error (UltCombo)

## [1.1.12] - 2011-08-11

### Changed

- Enhanced the trailing space management

### Fixed

- Fixed the insertion on empty selection

## [1.1.11] - 2011-07-19

### Added

- Enabled parsing the markup in javascript (amroth)
- Added multiline support (alevchuk)
- Added quotes to attribute selectors
- Added metakey support for Mac users (michal-krause)

### Changed

- Updated with jQuery 1.6.2

### Fixed

- Tried to fix the endless IE caret position bug

## [1.1.10] - 2011-02-20

### Changed

- Improved: Ajax property 'dataType' set to 'text'
- Improved: Ajax property 'global' set to 'false'

### Fixed

- Fixed: Ctrl+click selection problem

## [1.1.9] - 2010-11-04

### Changed

- Improved: Selection accuracy in Internet Explorer
- Improved: Replace focusin() by bind('focusin') to solve some backward compatibility issues (Nick B. C.)
- Cosmetic: Add new logo
- Cosmetic: Remove jQuery library and use CDN

## [1.1.8] - 2010-08-27

### Changed

- Improved: Some skin PNG have been optimized (lukescammell)
- Improved: Avoid giving the preview focus each time autorefresh kicks in. It still gets the focus when the preview button is pressed (DrSlump)
- Improved: In pop-up mode the preview is closed when the page containing the editor is unloaded (DrSlump)
- Improved: Press TAB jump right inside the textarea (Yakir)

### Fixed

- Fixed: Opera 10 selection bug (Marius G.)
- Fixed: Accessibility issue with the background default color in the default skin

## [1.1.7] - 2010-04-06

### Fixed

- Fixed: Empty lines are removed at insertion on Webkit
- Fixed: Focus lost when shortcut is used on FF
- Fixed: var missing before $$ in markItUpRemove()

## 1.1.6.1 - 2010-03-02

### Added

- Git is used for versioning and tagging

## 1.1.6 - 2010-01-12

### Changed

- Improved: Ajax requests are now asynchronous

### Fixed

- Fixed: Double empty line problem with preview and parsers
- Fixed: IE8 now close the preview properly

## 1.1.5 - 2009-05-01

### Changed

- Modified: http://drupal.org/project/wysiwyg compatibility
- Modified: Alt/Ctrl/Alt+Tab are now disabled

## 1.1.4 - 2008-12-03

### Fixed

- Fixed: Extra quote deleted line 95

## 1.1.3 - 2008-09-12

### Fixed

- Fixed: IE7 preview problem

## 1.1.2 - 2008-07-17

### Fixed

- Fixed: Quick fix for Opera 9.5 caret position problem after insertion

## 1.1.1 - 2008-06-02

### Changed

- Improved: ScrollPosition is kept in the preview when its refreshed

### Fixed

- Fixed: Key events status are passed to callbacks properly

## 1.1.0 - 2008-05-04

### Added

- Added: Relative path to the script is computed
- Added: Relative path to the script passed to callbacks
- Added: Global instance ID property
- Added: $(element).markItUpRemove() to remove markItUp!
- Added: Resize handle is now optional with resizeHandle property
- Added: Property previewInWindow is added and accept window parameter
- Added: Property previewPosition is added

### Changed

- Modified: Textarea's id is no more moved to the main container
- Modified: NameSpace Span become a Div to remain strict
- Modified: Resize handle is no more displayed in Safari to avoid repetition with the native handle
- Modified: Property previewIframeRefresh become previewAutorefresh
- Modified: Built-in Html Preview call a template file
- Improved: Autorefreshing is now apply for preview in window too
- Improved: Cancel button in prompt window cancel now the whole insertion process
- Improved: Cleaner markItUp! code added to the DOM

### Fixed

- Fixed: "Magic markups" works with line feeds
- Fixed: Key events are initialized after insertion
- Fixed: Internet Explorer line feed offset bug
- Fixed: Shortcut keys on Mac OS
- Fixed: Ctrl+click works and doesn't open Mac context menu anymore
- Fixed: Ctrl+click works and doesn't open the page in a new tab anymore
- Fixed: Minor Css modifications

### Removed

- Removed: Depreciated preview properties as previewBaseUrl, previewCharset, previewCssPath, previewBodyId, previewBodyClassName
- Removed: Property previewIframe not longer exists

## 1.0.3 - 2008-04-04

### Added

- Added: Property scrollPosition is passed to callbacks functions

### Fixed

- Fixed: IE7 Preview empty baseurl problem
- Fixed: IE7 external targeted insertion

## 1.0.2 - 2008-03-31

### Changed

- Improved: Code minified

### Fixed

- Fixed: IE7 Html preview problems
- Fixed: Selection is kept if nothing is inserted

## 1.0.1 - 2008-03-21

### Changed

- Modified: Property previewCharset is setted to "utf-8" by default

### Removed

- Removed: Global PlaceHolder

## 1.0.0 - 2008-03-01

### Added

- First public release

[Unreleased]: https://github.com/markitup/1.x/compare/1.1.15...HEAD
[1.1.15]: https://github.com/markitup/1.x/compare/1.1.14...1.1.15
[1.1.14]: https://github.com/markitup/1.x/compare/1.1.13...1.1.14
[1.1.13]: https://github.com/markitup/1.x/compare/1.1.12...1.1.13
[1.1.12]: https://github.com/markitup/1.x/compare/1.1.11...1.1.12
[1.1.11]: https://github.com/markitup/1.x/compare/1.1.10...1.1.11
[1.1.10]: https://github.com/markitup/1.x/compare/1.1.9...1.1.10
[1.1.9]: https://github.com/markitup/1.x/compare/1.1.8...1.1.9
[1.1.8]: https://github.com/markitup/1.x/compare/1.1.7...1.1.8
[1.1.7]: https://github.com/markitup/1.x/compare/1.1.6.1...1.1.7
