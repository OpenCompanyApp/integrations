<?php
namespace OpenCompany\Integrations\Instapaper\Tools;
/** Delete an Instapaper folder. */
class InstapaperDeleteFolder extends AbstractInstapaperTool { protected const NAME = 'instapaper_delete_folder'; protected const DESCRIPTION = 'Delete an Instapaper folder by folder_id.'; protected const OPERATION = 'delete_folder'; protected const REQUIRED = ['folder_id']; }
