<html>
<head></head>
<body>
<table>
  <tr><th>Name</th><th>IP Address</th></tr>
  {foreach $hosts as $hostentry}
    {foreach from=$hostentry key=name item=ip}
    <tr><td>{$name}</td><td>{$ip}</td></tr>
    {/foreach}
  {/foreach}
</table>
</body>
</html>
