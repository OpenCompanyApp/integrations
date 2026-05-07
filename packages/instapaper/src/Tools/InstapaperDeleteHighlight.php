<?php
namespace OpenCompany\Integrations\Instapaper\Tools;
/** Delete an Instapaper highlight. */
class InstapaperDeleteHighlight extends AbstractInstapaperTool { protected const NAME = 'instapaper_delete_highlight'; protected const DESCRIPTION = 'Delete an Instapaper highlight by highlight_id.'; protected const OPERATION = 'delete_highlight'; protected const REQUIRED = ['highlight_id']; }
