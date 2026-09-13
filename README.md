# MailingTeams (au.com.agileware.mailingteams)

MailingTeams is a companion extension for [CiviTeams](https://github.com/agileware/au.com.agileware.teams) that
adds Team-based access control to CiviMail. Without it, any contact with the CiviCRM permission `access CiviMail`
can draft, edit, and send a mailing to any group using any "From Email Address". MailingTeams lets you restrict
that: a Team can be scoped to only draft mailings for certain groups, only approve/publish mailings for certain
groups, and only send from certain "From Email Addresses". Contacts who are not members of a Team with the
relevant permission for a given group or from address are prevented from drafting, approving or sending that
mailing.

This is useful for organisations where multiple departments or chapters share one CiviCRM instance and need to
send their own mailings to their own audience, without being able to see or send to other departments' mailing
lists or from other departments' email addresses.

The extension is licensed under [AGPL-3.0](LICENSE.txt).

## Requirements

* PHP v8.1+ (per CiviCRM 5.67+ requirements)
* CiviCRM 5.67+
* [CiviTeams](https://github.com/agileware/au.com.agileware.teams) — MailingTeams is a plugin for CiviTeams and
  requires it to be installed and enabled. CiviTeams provides the `Team`, `TeamContact` entities and the
  "Teams" settings/listing screens that MailingTeams extends.

## Usage

Once CiviTeams and MailingTeams are both installed, every Team gets a new "Mailing" section on its settings form
(Administer / Teams / Team Settings, `CRM_Team_Form_Settings`), with the following options:

* **Restricted** — a checkbox. When checked, the Team cannot load or copy Mailings that were created by another
  Team (i.e. it cannot use another Team's mailing as a template).
* **From Email Addresses** — the set of CiviMail "From Email Addresses" (configured under Administer / CiviMail /
  From Email Addresses) that this Team is permitted to send mailings from.
* **Draft Groups** — the mailing-list Groups that this Team can draft mailings for.
* **Publish Groups** — the mailing-list Groups that this Team can approve and schedule mailings for. Teams with
  Publish access to a Group can also Draft mailings for it.

The Team listing screen (Administer / Teams, `CRM_Team_Form_Teams`) gains two additional columns, **From Email
Addresses** and **Groups**, showing which addresses and groups each Team is linked to, and a search filter for
finding Teams by From Email Address or Group.

For contacts who do not have `access CiviMail` (and are not a Team Administrator), MailingTeams then transparently
enforces these settings throughout CiviCRM:

* The CiviMail recipients picker, group listing and "From Email Address" pick-lists only show the Groups and
  From Email Addresses the contact's Team(s) are allowed to use.
* Existing Mailings are only visible/editable if they target a Group the contact's Team can draft or publish
  for.
* The "Approve Mailing" action is only permitted if the contact's Team has Publish access to all of the
  Mailing's target Groups, and (if the Team is Restricted) the Mailing was created for that Team.

No separate menu items, Scheduled Jobs, or CiviRules actions are added by this extension — it works by
transparently applying ACL-style restrictions to the existing CiviMail screens and APIs.

### API

MailingTeams exposes three CiviCRM APIv3 entities (standard `get`/`create`/`delete` actions) used to manage the
underlying links, and normally maintained for you via the Team Settings form above:

* **TeamMailing** — links a Team to a Mailing it drafted (`team_id`, `mailing_id`).
* **TeamMailingFromAddress** — links a Team to a "From Email Address" it may use (`team_id`,
  `from_email_address_id`).
* **TeamMailingGroup** — links a Team to a Group, with a `role` of either `draft` or `publish` (`team_id`,
  `group_id`, `role`).

## Special configuration requirements

* CiviTeams must be installed and enabled before MailingTeams; MailingTeams has no function without it.
* Contacts who should be restricted by Team must **not** be given the `access CiviMail` permission directly, as
  that permission bypasses all MailingTeams restrictions (by design, so CiviMail administrators are unaffected).
  Grant those contacts access via their Team assignment instead.
* No API keys, OAuth credentials, or other external service configuration is required — all configuration is
  done through the standard CiviCRM/CiviTeams admin screens described above.

## Installation (Web UI)

Learn more about installing CiviCRM extensions in the [CiviCRM Sysadmin
Guide](https://docs.civicrm.org/sysadmin/en/latest/customize/extensions/).

About the Authors
-----------------

This CiviCRM extension was developed by the team at [Agileware](https://agileware.com.au).

[Agileware](https://agileware.com.au) provide a range of CiviCRM services including:

  * CiviCRM migration
  * CiviCRM integration
  * CiviCRM extension development
  * CiviCRM support
  * CiviCRM hosting
  * CiviCRM remote training services

Support your Australian [CiviCRM](https://civicrm.org) developers, [contact Agileware](https://agileware.com.au/contact) today!

![Agileware](logo/agileware-logo.png)
