<?php

namespace OpenCompany\Integrations\Pulumi\Tools;

/**
 * GetGroupsForGitLabApp.
 *
 * Maps to the official Pulumi Cloud endpoint get /api/user/gitlab-app/organizations.
 */
class PulumiUsersGetGroupsForGitLabApp extends AbstractPulumiTool
{
    protected const NAME = 'pulumi_users_get_groups_for_git_lab_app';
    protected const DESCRIPTION = 'GetGroupsForGitLabApp

Official Pulumi Cloud endpoint: GET /api/user/gitlab-app/organizations

Gets a list of GitLab groups available to be used with the Pulumi GitLab app. This endpoint explicitly denotes which groups can be used based on the user\'s permissions within each group.';
    protected const PARAMETERS = array (
);
    protected const METHOD = 'get';
    protected const PATH = '/api/user/gitlab-app/organizations';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
