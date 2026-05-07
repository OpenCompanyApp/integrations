<?php
namespace OpenCompany\Integrations\Instapaper\Tools;
/** Delete an Instapaper bookmark. */
class InstapaperDeleteBookmark extends AbstractInstapaperTool { protected const NAME = 'instapaper_delete_bookmark'; protected const DESCRIPTION = 'Delete an Instapaper bookmark by bookmark_id.'; protected const OPERATION = 'delete_bookmark'; protected const REQUIRED = ['bookmark_id']; }
