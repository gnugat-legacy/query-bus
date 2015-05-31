# Changes between versions

## 2.0.0: Removed priorities

* removed priority parameter from `QueryBus#add`

> **Note**: BC break, `QueryBus#add` no longer has a priority argument.

## 1.0.0: Handling interrogatory messages

* `QueryBus` executes the appropriate `QueryMatcher`
* priorization of `QueryMatcher` when registering it in `QueryBus`
