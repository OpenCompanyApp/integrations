# Google Contacts

Google Contacts tools are exposed under `app.integrations.google_contacts`. This package is generated from Google's official People API v1 Discovery document and exposes 24 REST methods.

## Coverage

- Source: `https://people.googleapis.com/$discovery/rest?version=v1`
- Read tools: 11
- Write tools: 13
- Base URL: `https://people.googleapis.com`

## Usage Notes

Pass resource names such as `people/c123`, `otherContacts/c123`, or `contactGroups/myContacts` exactly as Google documents them. Path parameters named `resourceName` use reserved expansion so slash-delimited resource names are preserved. Query parameters can be passed as top-level shortcuts or inside `query`. Create, update, batch, photo, and member-modify methods accept the official JSON request object inside `body`.

For People API reads, include the required field masks such as `personFields`, `readMask`, or `sources` when the upstream method requires them.

## Tools

- `google_contacts_people_search_directory_people` - GET /v1/people:searchDirectoryPeople
- `google_contacts_people_delete_contact_photo` - DELETE /v1/{+resourceName}:deleteContactPhoto
- `google_contacts_people_batch_delete_contacts` - POST /v1/people:batchDeleteContacts
- `google_contacts_people_create_contact` - POST /v1/people:createContact
- `google_contacts_people_list_directory_people` - GET /v1/people:listDirectoryPeople
- `google_contacts_people_update_contact` - PATCH /v1/{+resourceName}:updateContact
- `google_contacts_people_update_contact_photo` - PATCH /v1/{+resourceName}:updateContactPhoto
- `google_contacts_people_get` - GET /v1/{+resourceName}
- `google_contacts_people_delete_contact` - DELETE /v1/{+resourceName}:deleteContact
- `google_contacts_people_get_batch_get` - GET /v1/people:batchGet
- `google_contacts_people_batch_update_contacts` - POST /v1/people:batchUpdateContacts
- `google_contacts_people_search_contacts` - GET /v1/people:searchContacts
- `google_contacts_people_batch_create_contacts` - POST /v1/people:batchCreateContacts
- `google_contacts_people_connections_list` - GET /v1/{+resourceName}/connections
- `google_contacts_other_contacts_list` - GET /v1/otherContacts
- `google_contacts_other_contacts_search` - GET /v1/otherContacts:search
- `google_contacts_other_contacts_copy_other_contact_to_my_contacts_group` - POST /v1/{+resourceName}:copyOtherContactToMyContactsGroup
- `google_contacts_contact_groups_create` - POST /v1/contactGroups
- `google_contacts_contact_groups_get` - GET /v1/{+resourceName}
- `google_contacts_contact_groups_list` - GET /v1/contactGroups
- `google_contacts_contact_groups_batch_get` - GET /v1/contactGroups:batchGet
- `google_contacts_contact_groups_update` - PUT /v1/{+resourceName}
- `google_contacts_contact_groups_delete` - DELETE /v1/{+resourceName}
- `google_contacts_contact_groups_members_modify` - POST /v1/{+resourceName}/members:modify

## Examples

```js
var groups = app.integrations.google_contacts.google_contacts_contact_groups_list({ pageSize: 10 })

var contacts = app.integrations.google_contacts.google_contacts_people_connections_list({
  resourceName: "people/me",
  personFields: "names,emailAddresses,phoneNumbers",
})
```
Responses are decoded Google People API JSON responses, or `{ success = true, status = ... }` for successful empty responses.
