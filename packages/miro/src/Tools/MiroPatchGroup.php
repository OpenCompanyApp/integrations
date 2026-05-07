<?php

namespace OpenCompany\Integrations\Miro\Tools;

/**
 * Updates an existing group resource, i.e. a team, overwriting values for specified attributes. Patch operation for group can be used to add, remove, or replace team members and to update the display name of the group (team). To add a user to the group (team), use add operation. To remove a user from a group (team), use remove operation. To update a user resource, use the replace operation. The last team admin cannot be removed from the team. Note: Attributes that are not provided will remain unchanged. PATCH operation only updates the fields provided. Team members removal specifics: For remove or replace operations, the team member is removed from the team and from all team boards. The ownership of boards that belong to the removed team member is transferred to the oldest team member who currently has an admin role. After you remove a team member, adding the team member again to the team does not automatically restore their previous ownership of the boards. If the user is not registered fully in Miro and is not assigned to any other team, the user is also removed from the organization. Add team members specifics: All added team members are reactivated or recreated if they were deactivated or deleted earlier. External users specifics: When adding existing users with the role ORGANIZATION_EXTERNAL_USER or ORGANIZATION_TEAM_GUEST_USER to a team, we set FULL license and ORGANIZATION_INTERNAL_USER roles..
 *
 * Maps to the official Miro endpoint PATCH /Groups/{id}.
 */
class MiroPatchGroup extends AbstractMiroTool
{
    protected const NAME = 'miro_patch_group';
    protected const DESCRIPTION = 'Updates an existing group resource, i.e. a team, overwriting values for specified attributes. Patch operation for group can be used to add, remove, or replace team members and to update the display name of the group (team). To add a user to the group (team), use add operation. To remove a user from a group (team), use remove operation. To update a user resource, use the replace operation. The last team admin cannot be removed from the team. Note: Attributes that are not provided will remain unchanged. PATCH operation only updates the fields provided. Team members removal specifics: For remove or replace operations, the team member is removed from the team and from all team boards. The ownership of boards that belong to the removed team member is transferred to the oldest team member who currently has an admin role. After you remove a team member, adding the team member again to the team does not automatically restore their previous ownership of the boards. If the user is not registered fully in Miro and is not assigned to any other team, the user is also removed from the organization. Add team members specifics: All added team members are reactivated or recreated if they were deactivated or deleted earlier. External users specifics: When adding existing users with the role ORGANIZATION_EXTERNAL_USER or ORGANIZATION_TEAM_GUEST_USER to a team, we set FULL license and ORGANIZATION_INTERNAL_USER roles.

Official Miro endpoint: PATCH /Groups/{id}.';
    protected const PARAMETERS = array (
      'id' => array (
        'type' => 'string',
        'description' => 'Group (Team) ID. A server-assigned, unique identifier for this Group (team).',
        'required' => true,
      ),
      'attributes' => array (
        'type' => 'string',
        'description' => 'A comma-separated list of attribute names to return in the response. Example attributes: id,displayName It is also possible to fetch attributes within complex attributes, for Example: members.display',
        'required' => false,
      ),
      'body' => array (
        'type' => 'object',
        'description' => 'Payload to add, replace, remove members in the specified group (team). The body of a PATCH request must contain the attribute `Operations` and its value is an array of one or more PATCH operations. Each PATCH operation object must have exactly one `op` member.',
        'required' => true,
      ),
    );
    protected const METHOD = 'PATCH';
    protected const PATH = '/Groups/{id}';
    protected const PATH_PARAMS = array (
      'id' => 'id',
    );
    protected const QUERY_PARAMS = array (
      'attributes' => 'attributes',
    );
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
    protected const BODY_CONTENT_TYPE = 'application/scim+json';
}
