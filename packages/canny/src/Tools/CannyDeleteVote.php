<?php
namespace OpenCompany\Integrations\Canny\Tools;
/** Delete a Canny vote. */
class CannyDeleteVote extends AbstractCannyTool { protected const NAME = 'canny_delete_vote'; protected const DESCRIPTION = 'Delete a Canny vote by postID and voterID.'; protected const OPERATION = 'delete_vote'; protected const REQUIRED = ['postID', 'voterID']; }
