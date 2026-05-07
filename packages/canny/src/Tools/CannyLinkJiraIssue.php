<?php
namespace OpenCompany\Integrations\Canny\Tools;
/** Link a Jira issue to a Canny post. */
class CannyLinkJiraIssue extends AbstractCannyTool { protected const NAME = 'canny_link_jira_issue'; protected const DESCRIPTION = 'Link a Jira issue to a Canny post.'; protected const OPERATION = 'link_jira_issue'; protected const REQUIRED = ['postID', 'issueID']; }
