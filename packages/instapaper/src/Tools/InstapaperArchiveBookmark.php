<?php
namespace OpenCompany\Integrations\Instapaper\Tools;
/** Archive an Instapaper bookmark. */
class InstapaperArchiveBookmark extends AbstractInstapaperTool { protected const NAME = 'instapaper_archive_bookmark'; protected const DESCRIPTION = 'Archive an Instapaper bookmark by bookmark_id.'; protected const OPERATION = 'archive_bookmark'; protected const REQUIRED = ['bookmark_id']; }
