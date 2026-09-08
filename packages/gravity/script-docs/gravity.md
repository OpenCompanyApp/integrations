# Gravity Forms — Ruby API Reference

Use `app.integrations.gravity` to list forms, inspect form definitions, submit data, and read submissions or entries.

## gravity_list_forms

List forms with optional pagination.

```ruby
result = app.integrations.gravity.list_forms(limit: 25, offset: 0)
```
## gravity_get_form

Get details for a form.

```ruby
result = app.integrations.gravity.get_form(form_id: "contact")
```
## gravity_submit_form

Submit form field values.

```ruby
result = app.integrations.gravity.submit_form(form_id: "contact", data: {name: "Example User", message: "Hello from an agent"})
```
## gravity_list_submissions

List submissions for a form.

```ruby
result = app.integrations.gravity.list_submissions(form_id: "contact", limit: 25)
```
## gravity_list_entries

List entries for a form.

```ruby
result = app.integrations.gravity.list_entries(form_id: "contact", limit: 25)
```
## gravity_get_entry

Get one entry by ID.

```ruby
result = app.integrations.gravity.get_entry(entry_id: "entry_123")
```
## gravity_get_current_user

Get profile information for the authenticated Gravity user.

```ruby
result = app.integrations.gravity.get_current_user()
```