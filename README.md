<p align="center"><a href="https://spec.tacul.ar" target="_blank"><img src="https://raw.githubusercontent.com/syntheticminds/spectacular/master/public/images/logo.svg" width="400" alt="Spectacular Logo"></a></p>

## About Spectacular

Spectacular is an open-source functional specification manager.

* Create detailed specfications
* Maintain them as requirements change
* Estimate effort and track progress
* Document ambiguities and highlight blockers
* Export to Markdown and HTML effortlessly

### Features in the works...
* More export formats
* Dark mode for working late
* Browsable changelog (changes are already being stored!)
* Versioning, including a comparison tool
* Obligatory AI integration

## Installation

Spectacular installs like any other Laravel application.

```bash
git clone https://github.com/syntheticminds/spectacular.git
cd spectacular
composer setup
# Set your APP_URL in the .env file
```

To upgrade, simply grab the latest code and run `composer setup` again.

### Docker

If you don't have PHP available, you can run the app locally with Docker. You'll find it running at [http://localhost:8000](http://localhost:8000).

```bash
git pull
docker compose up --build
```

Upgrades are simple too - just grab the latest code and rebuild the container. The database will be preservered.

### Spectacular Cloud

For a zero-configuration hosted solution with extra collaboration feaures, use [Spectacular Cloud](https://spec.tacul.ar) (coming soon!).

## Contributing

Thank you for considering contributing to Spectacular! Please see CONTRIBUTING.md for more information.

## Code of Conduct

The Spectacular code of conduct is derived from the Laravel code of conduct. Any violations of the code of conduct may be reported to Matthew White (matt@matthewwhite.me.uk):

* Participants will be tolerant of opposing views.
* Participants must ensure that their language and actions are free of personal attacks and disparaging personal remarks.
* When interpreting the words and actions of others, participants should always assume good intentions.
* Behavior that can be reasonably considered harassment will not be tolerated.

## Security

If you discover a security vulnerability within Spectacular, please send an e-mail to Matthew White via [matt@matthewwhite.me.uk](mailto:matt@matthewwhite.me.uk). All security vulnerabilities will be promptly addressed.

## License

Spectacular - an open-source functional specification manager\
Copyright (C) 2026 Matthew White

This program is free software: you can redistribute it and/or modify
it under the terms of the GNU Affero General Public License as published by
the Free Software Foundation, either version 3 of the License, or
(at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU Affero General Public License for more details.

You should have received a copy of the GNU Affero General Public License
along with this program.  If not, see <https://www.gnu.org/licenses/>.