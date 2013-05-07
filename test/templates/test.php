<?php
if(!defined('INIT_SENSITIVE')) { exit; }
include $_SRCPath.'/test/templates/header.php';
?>
<div class="container">

    <h1>Page</h1>
    <p><strong>This is a Page.</strong></p>

    <pre>
<?php if($testname) { print_r($testname); }?>
<?php if($bean) { print_r($bean); }?>
<?php if($array) { print_r($array); }?>
    </pre>

    <div id="suggestions">
        <a href="http://sensitive.laysoft.cn/contact">Contact Support</a> —
        <a href="http://sensitive.laysoft.cn/project">Sensitive Project</a> —
        <a href="http://sensitive.laysoft.cn/status">@sensitivestatus</a>
    </div>

    <a href="/" class="logo logo-img-1x">
        <img width="32" height="32" title="" alt="" src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAACAAAAAgCAYAAABzenr0AAAAGXRFWHRTb2Z0d2FyZQBBZG9iZSBJbWFnZVJlYWR5ccllPAAAAyRpVFh0WE1MOmNvbS5hZG9iZS54bXAAAAAAADw/eHBhY2tldCBiZWdpbj0i77u/IiBpZD0iVzVNME1wQ2VoaUh6cmVTek5UY3prYzlkIj8+IDx4OnhtcG1ldGEgeG1sbnM6eD0iYWRvYmU6bnM6bWV0YS8iIHg6eG1wdGs9IkFkb2JlIFhNUCBDb3JlIDUuMy1jMDExIDY2LjE0NTY2MSwgMjAxMi8wMi8wNi0xNDo1NjoyNyAgICAgICAgIj4gPHJkZjpSREYgeG1sbnM6cmRmPSJodHRwOi8vd3d3LnczLm9yZy8xOTk5LzAyLzIyLXJkZi1zeW50YXgtbnMjIj4gPHJkZjpEZXNjcmlwdGlvbiByZGY6YWJvdXQ9IiIgeG1sbnM6eG1wPSJodHRwOi8vbnMuYWRvYmUuY29tL3hhcC8xLjAvIiB4bWxuczp4bXBNTT0iaHR0cDovL25zLmFkb2JlLmNvbS94YXAvMS4wL21tLyIgeG1sbnM6c3RSZWY9Imh0dHA6Ly9ucy5hZG9iZS5jb20veGFwLzEuMC9zVHlwZS9SZXNvdXJjZVJlZiMiIHhtcDpDcmVhdG9yVG9vbD0iQWRvYmUgUGhvdG9zaG9wIENTNiAoTWFjaW50b3NoKSIgeG1wTU06SW5zdGFuY2VJRD0ieG1wLmlpZDo1Q0EwODYxRTlGQjcxMUUyODZFNEMyMjBCNzE0Q0JGNCIgeG1wTU06RG9jdW1lbnRJRD0ieG1wLmRpZDo1Q0EwODYxRjlGQjcxMUUyODZFNEMyMjBCNzE0Q0JGNCI+IDx4bXBNTTpEZXJpdmVkRnJvbSBzdFJlZjppbnN0YW5jZUlEPSJ4bXAuaWlkOjFGMjYzQzg5OUZCNjExRTI4NkU0QzIyMEI3MTRDQkY0IiBzdFJlZjpkb2N1bWVudElEPSJ4bXAuZGlkOjFGMjYzQzhBOUZCNjExRTI4NkU0QzIyMEI3MTRDQkY0Ii8+IDwvcmRmOkRlc2NyaXB0aW9uPiA8L3JkZjpSREY+IDwveDp4bXBtZXRhPiA8P3hwYWNrZXQgZW5kPSJyIj8+Cwlf8AAAAuBJREFUeNrEl0tIVVEUhs89OkhIe1Cmk7q3oiAwMCuIGtQlKBokZEjQ1KKhYEE0qVEGlhQ0s1HQpLRL5SDCKHqM0oQcaJk3etHDsvRGRlmnf8F/4bjb69xzvEda8A3Ofqz1n/1Ye+/ESPaFE9IWgXqwDawFKTCXdd+AOHoC7oBr4FMYp4kQAmrBUbAHlIYUOwWuglOgP6ihG1A3D3SAPtAYIbjDto3s20FfkQTUUnmTjJIzc0vQRz99hhKQBnc5x3FZij7ThQTUgQyocOK3Cvqu0wQsAJ1G8EEupokZBJxg30FDRCdj/SPgDEgaTk6CBlDJufzg23YD4B4ZYJnDNk3s00Affksy1rRtuB48svyFDNdjY2dUg2fgj2U6V4F3YNxXvo67wbQNoDc/AseUYSwxvsXxkCW4w7IhI7jNh+OPKQKqwG6l0ZoYFp/mQ2JWuUyvNpVvwI0YBIiP18ro1ru2vUk7DsZiECA+Tih1aRFQY6n4DbpizAFd9GlajWvZemJvLYupGBunT9OSIqDMUvFzFjLhL0tZmXYYLZkFAZXaYZSzlJdrHYoIXm4pz4mArNJpZ4wCNF9ZV0mTYi0RLyFBl5MWpa5PBPQolXLva4tBQBt92axHBHSD70qDZnCF6TqqVbNvs1IvMbvzi/CioXgruM/vveAVuAwO8OQsUYZ6EzjEe8BL9tVMYubyx/FS8BTMAR44As7zrN9odMzwnPcs978Mz5ZC9gOslh/L5wH5w1afo9O8RO6zHCTtluAOy9pDTk8rY057F5Ty4riZ37fADjCffyzJqRfcVvK62GLwsUDwh5ziKdvDRBbbA7DCtwjPRVh4IvZLQP0I2ALeB72MlnFrruS3CLoORinwLOcwqoDnYDsXZ8Gn2UJwSclgcqP9GlHATbDfdr9wAy4Ru7jtRotIQvJAPUhfY1HfhrKqL4Dl4DAYBp/BZECfSbYZ5lZO8W3oqW83z/Oc/2l/BRgAx0yx3NLWxQgAAAAASUVORK5CYII=">
    </a>
</div>
<?php
include $_SRCPath.'/test/templates/footer.php';
?>
