<?php
namespace OpenCompany\Integrations\Canny\Tools;
/** Unlink a Jira issue from a Canny post. */
class CannyUnlinkJiraIssue extends AbstractCannyTool { protected const NAME = 'canny_unlink_jira_issue'; protected const DESCRIPTION = 'Unlink a Jira issue from a Canny post.'; protected const OPERATION = 'unlink_jira_issue'; protected const REQUIRED = ['postID', 'issueID']; }
