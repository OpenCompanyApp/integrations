<?php
namespace OpenCompany\Integrations\Canny\Tools;
/** Move a Canny post to another board. */
class CannyChangePostBoard extends AbstractCannyTool { protected const NAME = 'canny_change_post_board'; protected const DESCRIPTION = 'Move a Canny post to another board.'; protected const OPERATION = 'change_post_board'; protected const REQUIRED = ['postID', 'boardID']; }
