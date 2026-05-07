<?php
namespace OpenCompany\Integrations\Instapaper\Tools;
/** Unarchive an Instapaper bookmark. */
class InstapaperUnarchiveBookmark extends AbstractInstapaperTool { protected const NAME = 'instapaper_unarchive_bookmark'; protected const DESCRIPTION = 'Move an archived Instapaper bookmark back to unread by bookmark_id.'; protected const OPERATION = 'unarchive_bookmark'; protected const REQUIRED = ['bookmark_id']; }
