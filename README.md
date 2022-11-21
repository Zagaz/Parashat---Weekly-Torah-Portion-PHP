# Week's Parashat
A simple way to have an array with information about this week Torah portion on your application in PHP.

## Intro
It is a custom among religious Jewish communities for a weekly Torah portion to be read during Jewish prayer services on Monday, Thursday, and Saturday. The full name, **Parashat HaShavua** (Hebrew: פָּרָשַׁת הַשָּׁבוּעַ), is popularly abbreviated to parashah (also parshah /pɑːrʃə/ or parsha), and is also known as a Sidra or Sedra /sɛdrə/.

The parashah is a section of the Torah (Five Books of Moses) used in Jewish liturgy during a particular week. There are 54 parshas, or parashiyot in Hebrew, and the full cycle is read over the course of one Jewish year.

## Install

Just place `parashat.php` on a folder of your choice.
On the page you want the the data, use: require 'parashat.php';

You will have the `$parashat_array`, see the example bellow:

Array
```
(
    [parashat_title] => Shoftim
    [parashat_date] => 2022-09-03
    [parashat_hebrew] => פרשת שופטים
    [parashat_torah] => Devarim/Deuteronômio
    [haftorah] => Isaiah 51:12-52:12
)
```


