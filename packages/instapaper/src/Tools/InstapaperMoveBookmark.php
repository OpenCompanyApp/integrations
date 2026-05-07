<?php
namespace OpenCompany\Integrations\Instapaper\Tools;
/** Move an Instapaper bookmark to a folder. */
class InstapaperMoveBookmark extends AbstractInstapaperTool { protected const NAME = 'instapaper_move_bookmark'; protected const DESCRIPTION = 'Move an Instapaper bookmark to a target folder_id.'; protected const OPERATION = 'move_bookmark'; protected const REQUIRED = ['bookmark_id', 'folder_id']; }
