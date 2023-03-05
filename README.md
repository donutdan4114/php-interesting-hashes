# Interesting Hashes

This script is designed to find some interesting hashes. The default agorithm is `md5` (because of speed), but you could change it.

### Overview

Examples of what this script finds.

| Start Hash                       | Mid Hash                             | End Hash                             | Type  |
|----------------------------------|--------------------------------------|--------------------------------------|-------|
| 2815b7eea085b019d2b1905b4fa02534 | **1bd29e**ed3395cf5d86c65be5864d44e7 | **1bd29e**befde05fbb3521fbbdef1b4305 | match |
| 2be5b64b5fc7a8a32774f37d94741ffb | 5ec819ae282a4f2dbd421eca80a6faf7     | **000000**94d75fdd8241f7b2e8898ee671 | zeros |
| a5204677e4710b183e720690b41d4e2a | a71f786bb9be81d0dbe6f9282ad8a988     | **ffffff**da437959787354010fab9e89c6 | f's   |

Try hashing `b350ce3d00952de6f145fb22bbcec676` [here](https://emn178.github.io/online-tools/md5.html).

So it can find hashes that:

* Start with `<n>` number of zeros.
* Start with `<n>` number of "f"s.
* Start with the same `<n>` number of characters of the input hash.

### Usage

```php
php md5.php
```

"Interesting" hashes are appended to `output.txt`. You can run multiple scripts in parallel to try and find a solution.

Output format:

```
--------- start hash ---------- -> -------- mid hash ------------ -> ---------- end hash ----------- (match)
7c3d64dee08c3bb1ce08f769a58a1a7e->fe27c1bd0510ec2311a5e917ba896bba->ffffff75961622975b8304b4437446e9 (6)
```

### Editing the Script

Changing the `$x` variable will allow you find more interesting hashes. The higher `$x` is, the more characters that must match, and the harder it is to find.

For example, to a find a hash that starts with 8 zeros could take around 15 minutes depending on CPU.

Each additional match will take around 16x longer...

Each additional script your run in parallel will cut the time by half.

| `$x` | time       |
|------|------------|
| 6    | 5 seconds  |
| 7    | 1 minute   |
| 8    | 15 minutes |
| 9    | 4 hours    |
| 10   | 2.5 days   |
| 11   | 1 month    |
| 12   | 1 year     |
| 13   | 16 years   |
| 14   | 256 years  |

