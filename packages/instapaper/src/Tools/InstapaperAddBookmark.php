<?php
namespace OpenCompany\Integrations\Instapaper\Tools;
/** Add a bookmark to Instapaper. */
class InstapaperAddBookmark extends AbstractInstapaperTool { protected const NAME = 'instapaper_add_bookmark'; protected const DESCRIPTION = 'Add a URL to Instapaper with optional title, selection, and folder_id fields.'; protected const OPERATION = 'add_bookmark'; protected const REQUIRED = ['url']; }
