<?php
namespace OpenCompany\Integrations\Instapaper\Tools;
/** Get readable HTML text for a bookmark. */
class InstapaperGetBookmarkText extends AbstractInstapaperTool { protected const NAME = 'instapaper_get_bookmark_text'; protected const DESCRIPTION = 'Get readable HTML text for an Instapaper bookmark by bookmark_id.'; protected const OPERATION = 'get_bookmark_text'; protected const REQUIRED = ['bookmark_id']; }
