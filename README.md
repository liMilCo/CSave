# Use
This file accept and save content that use GET or Post [s] or [c] as content also [t] as title

```bash
LINK /save.php?c=content
```

If url use c (or s) data will save automatically and responce if save success or not.

You can use [t] Optional for Title

```example
LINK /save.php?t=title&c=content
```

## Install

Upload [save.php](/save.php) and [data.txt](/data.txt) to server (PHP Suport)

set [data.txt](/data.txt) permissions to 0777

## Security

* Rename  [data.txt](/data.txt) and also change { $config['logfilename'] } in  [save.php](/save.php)@Config
* Chande default password (and username) from { $config['password'] }  but it should be in MD5 Hash #> if you search for 'md5 encrypt' ther are many site to encrypt your word



