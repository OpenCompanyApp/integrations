# Quickbase Ruby Reference

Namespace: `quickbase`

Quickbase tools target the REST API at `https://api.quickbase.com/v1`. Configure
a user token and realm hostname. The integration sends `Authorization:
Bearer <token>` and `QB-Realm-Hostname: <realm>`.

## Apps

```ruby
apps = app.integrations.quickbase.list_apps(params: {name: "Operations"})
app_meta = app.integrations.quickbase.get_app(app_id: "bqxxx")
```
Write tools include `create_app`, `copy_app`, and `delete_app`. Use delete
tools carefully; some realms require the app name as confirmation.

## Tables And Fields

```ruby
tables = app.integrations.quickbase.list_tables(app_id: "bqxxx")
table = app.integrations.quickbase.get_table(table_id: "brxxx")
fields = app.integrations.quickbase.list_fields(table_id: "brxxx", params: {includeFieldPerms: true})
field = app.integrations.quickbase.get_field(table_id: "brxxx", field_id: 6)
```
Write tools include `create_table`, `update_table`, `delete_table`,
`create_field`, `update_field`, and `delete_field`.

## Records

```ruby
records = app.integrations.quickbase.list_records(table_id: "brxxx", where: "{6.EX.'Open'}", select: [3, 6, 7], options: {skip: 0, top: 100})
created = app.integrations.quickbase.create_record(table_id: "brxxx", fields: [{fieldId: 6, value: "Open"}])
upserted = app.integrations.quickbase.upsert_records(table_id: "brxxx", data: [{5 => {value: "Open"}}], merge_field_id: 3, fields_to_return: [3, 6])
```
`delete_records({ tableId, where })` deletes every record matching the Quickbase
query expression. Build and review `where` clauses carefully.

## Reports And Relationships

```ruby
reports = app.integrations.quickbase.list_reports(table_id: "brxxx")
report = app.integrations.quickbase.get_report(table_id: "brxxx", report_id: "7")
rows = app.integrations.quickbase.run_report(table_id: "brxxx", report_id: "7", body: {skip: 0, top: 100})
```
Relationship tools include `list_relationships`, `create_relationship`, and
`delete_relationship`.

## User And Generic API

```ruby
user = app.integrations.quickbase.get_current_user()
raw = app.integrations.quickbase.api_get(path: "/fields", params: {tableId: "brxxx"})
```
Available generic tools: `api_get`, `api_post`, and `api_delete`. Use them for
documented REST endpoints not yet wrapped directly.
