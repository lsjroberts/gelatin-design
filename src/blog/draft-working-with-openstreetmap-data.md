---
template: post.html
title: Working with OpenStreetMap data
slug: working-with-openstreetmap-data
draft: true
date: 2014-08-22
tags:
    - openstreetmap
    - pimeariver
---
_opening blurb about how awesome open street map is_

## What does the data look like?

### Relations, Ways & Nodes

#### Nodes

**A single latitude/longitude point.**

```js
{
  "type": "node",
  "id": 1718118302,
  "lat": -9.6478613,
  "lon": 20.3443745
}
```

#### Ways

**A series of related nodes.** A way can represent a linear object, or the outline of a larger shape. For example; a linear list of nodes could represent a river (with the tag `waterway=river`), or an outline could represent a wide river (with the tag `waterway=riverbank`).

```js
{
  "type": "way",
  "id": 4422954,
  "nodes": [
    27125901,
    27125900,
    27125899,
    435959800,
    435562013
  ],
  "tags": {
    "name": "Funa",
    "waterway": "river"
  }
}
```

#### Relation

A series of related ways. If a single way is not enough to represent a feature, multiple ways can be grouped under a relation. Though this is not required if the feature is of limited size.

```js
{
  "type": "relation",
  "id": 171534,
  "members": [
    {
      "type": "way",
      "ref": 25469515,
      "role": "main_stream"
    },
    {
      "type": "way",
      "ref": 126024652,
      "role": "main_stream"
    }
}
```


## Where do I get this data from?



### You wouldn't download a car? Nah, but I'll download the planet

[Overpass](http://overpass-turbo.eu/) is a great tool to test your filters and preview the data that can be exported from OSM.



### Filtering data

### Importing data into MongoDB