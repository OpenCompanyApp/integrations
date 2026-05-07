<?php
namespace OpenCompany\Integrations\Instapaper\Tools;
/** Update bookmark reading progress. */
class InstapaperUpdateReadProgress extends AbstractInstapaperTool { protected const NAME = 'instapaper_update_read_progress'; protected const DESCRIPTION = 'Update read progress for an Instapaper bookmark.'; protected const OPERATION = 'update_read_progress'; protected const REQUIRED = ['bookmark_id', 'progress']; }
