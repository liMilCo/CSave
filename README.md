# Use
this file accept and save content that use GET or Post [s] or [c] as content also [t] as title

{example: LINK/save.php?t=title&c=content}

if url use c (or s) data will save automatically and responce if save success or not.

you can use [t] Optional for Title

# Install

upload "save.php" and "data.txt" to server (PHP Suport)

set "data.txt" permissions to 0777

#Security

rename  "data.txt" and also change { $config['logfilename'] } in  "save.php"@Config

chande default password (and username) from { $config['password'] }  but it should be in MD5 Hash #> if you search for 'md5 encrypt' ther are many site to encrypt your word



