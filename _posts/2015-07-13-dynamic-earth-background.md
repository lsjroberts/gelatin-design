---
title: Dynamic desktop background of Earth
titleSmall: Dynamic desktop background of 
titleStrong: Earth
date: 2015-07-13
category: coding
---

Japan have launched a new satellite that takes [super high resolution photos](http://www.nytimes.com/interactive/2015/07/10/science/An-Image-of-Earth-Every-Ten-Minutes.html) of the earth every 10 minutes.

![Earth top](/images/blog/2015-07-13/earth-top.png)

Awesome. I immediately wanted to get this setup to create an automatically updating desktop background. If you are on OSX you can do this with a couple of scripts.

Create a directory somewhere to keep these scripts and the downloaded image, e.g. `~/earth/`.

A [helpful dev on Hacker News](https://news.ycombinator.com/item?id=9867655) posted up [this script to download and combine](https://gist.github.com/Syrup-tan/1833ba1671c7017f0d59) the photo tiles together into a single image:

{% highlight bash %}
#!/bin/sh
## This script downloads an image of earth from Japan's Himawari8 satellite.
## It is configurable for 1,100^2, 2,200^2, or 8,800^2 pixel outputs.
## It requires;
##  montage(1) from imagemagick (http://www.imagemagick.org/)
##  date(1) from either BSD or GNU utils
##  curl(1) from http://curl.haxx.se/
##  jq(1) from https://stedolan.github.io/jq/

## Configuration
OUTPUT_FILENAME="/Users/[you]/earth/composite.png";
URL_BASE='http://himawari8.nict.go.jp/img/D531106';
## The amount of tiles on one side
## This value should be either 1, 2, 4, or 16
## Each tile is 550px x 550px, so 4 (default) will produce an image 2,200px x 2,200px
TILE_COUNT='4';

## Check requirements
if ! jq --version >/dev/null 2>&1; then
    echo "jq(1) is not installed, but is required by this script.";
    echo "Please see installation instructions at https://stedolan.github.io/jq/";
    exit 1;
fi;
if ! curl --version >/dev/null 2>&1; then
    echo "curl(1) is not installed, but is required by this script.";
    echo "Please see installation instructions at http://curl.haxx.se/";
    exit 1;
fi;
if ! montage --version >/dev/null 2>&1; then
    echo "montage(1) from ImageMagick is not installed, but is required by this script.";
    echo "Please see installation instructions at http://www.imagemagick.org/";
    exit 1;
fi;
if ! date >/dev/null 2>&1; then
    echo "date(1) is not installed, but is required by this script.";
    echo "Please get a copy for your OS from either GNU or BSD utils.";
    exit 1;
fi;

## Get the latest picture
LATEST_FILE="$(curl -s "${URL_BASE}/latest.json" | jq -r -e .date)";
if [ "$?" -ne 0 ]; then
    echo "Unable to get latest picture date";
    exit 1;
fi;

## Parse the date into the filename
DATE_FORMAT='+%Y/%m/%d/%H%M%S';
### Check if we're using GNU or BSD
if date -j >/dev/null 2>&1; then
    ## Get the date for date(1) from BSD utils
    IMAGE_URL="$(date -jf '%Y-%m-%d %H:%M:%S' "${LATEST_FILE}" "${DATE_FORMAT}")";
else
    ## Get the date for date(1) from GNU utils
    IMAGE_URL="$(date -d "${LATEST_FILE}" "${DATE_FORMAT}")";
fi;

## Make the directory for the images
TMP_IMAGE_DIR="$(mktemp -d /tmp/himawari8.XXXXXXXX)";

## Download each of the files
echo "Downloading tiles...";
X=0;
while [ "${X}" -lt "${TILE_COUNT}" ]; do
    Y=0;
    while [ "${Y}" -lt "${TILE_COUNT}" ]; do
        curl -so "${TMP_IMAGE_DIR}/${Y}_${X}.png" "${URL_BASE}/${TILE_COUNT}d/550/${IMAGE_URL}_${X}_${Y}.png";
        printf "\rDownloaded ${X}, ${Y} ($((X * TILE_COUNT + Y + 1)) / $((TILE_COUNT * TILE_COUNT)))";
        printf ' %0.s' {0..9};
        Y="$((Y+1))";
    done;
    X="$((X+1))";
done;

## Beautiful code
printf "\rTiles downloaded."; printf ' %0.s' {0..9}; printf '\n\n';

## Create the image
echo "Creating image...";
montage "${TMP_IMAGE_DIR}/"*.png -geometry 550x550 "${OUTPUT_FILENAME}" >/dev/null 2>&1;
echo "Image created: ${OUTPUT_FILENAME}";

## Remove the temporary directory
if [ -n "${TMP_IMAGE_DIR}" ]; then
    rm "${TMP_IMAGE_DIR}/"*.png;
    rmdir "${TMP_IMAGE_DIR}";
fi;

exit 0;
{% endhighlight %}

Save this into your directory as `~/earth/download.sh`, and replace the path `/Users/[you]/earth/composite.png` with the *absolute* path. Then try running it in your terminal:

{% highlight bash %}
$ sh ~/earth/download.sh
{% endhighlight %}

You may need to install a few dependencies, but if all goes well after a few moments you'll have a new image downloaded to `~/earth/composite.png`. Set this as your background manually and make sure it's configured how you want, i.e. fit to screen and background colour of black.

Next we need to create an applescript which sets this image as the background. Open _Script Editor_ and write this, replacing the path again:

{% highlight applescript %}
tell application "Finder"
    set desktop picture to POSIX file "/Users/[you]/earth/composite.png"
end tell
{% endhighlight %}

Try running it by clicking the play button, check it doesn't error and then save it as `~/earth/set-background.scpt`.

Now lastly you just need to make these run as often as you want the image to change. For this you can use cron or launchd, I went with cron as it's what I've always used.

{% highlight bash %}
$ crontab -e
{% endhighlight %}

{% highlight bash %}
0,30 * * * * sh /Users/[you]/earth/download.sh
5,35 * * * * osascript /Users/[you]/earth/set-background.scpt
{% endhighlight %}

Now every half hour your background should update to show the rotating Earth, lovely.

![Earth background](/images/blog/2015-07-13/earth-background.png)