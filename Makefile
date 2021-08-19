# Checks two given strings for equality.
eq = $(if $(or $(1),$(2)),$(and $(findstring $(1),$(2)),\
                                $(findstring $(2),$(1))),1)


# Resolve PHP project dependencies.
#
# Usage:
#   make deps

deps:
	composer install


# Runs PHP tests.
#
# Usage:
#   make test

test:
	echo 'test'


# Build PHP project.
#
# Usage:
#   make build

build:
	echo 'build'


# Release project on GitHub.
#
# Usage:
#   make release

release:
	-git tag -d latest
	git tag latest
	git push origin latest --force


.PHONY: deps build release test
