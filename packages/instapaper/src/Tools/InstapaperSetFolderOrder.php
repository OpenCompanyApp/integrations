<?php
namespace OpenCompany\Integrations\Instapaper\Tools;
/** Set the order of Instapaper folders. */
class InstapaperSetFolderOrder extends AbstractInstapaperTool { protected const NAME = 'instapaper_set_folder_order'; protected const DESCRIPTION = 'Set Instapaper folder order using a folder_ids payload field.'; protected const OPERATION = 'set_folder_order'; protected const REQUIRED = ['folder_ids']; }
