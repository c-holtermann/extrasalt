.. ==================================================
.. FOR YOUR INFORMATION
.. --------------------------------------------------
.. -*- coding: utf-8 -*- with BOM.

.. include:: ../Includes.txt


.. _developer:

Developer Corner
================

Target group: **Developers**

Salting methods:
----------------

+-----------------+------------------+-------------------------------------------------------------------------+---------------------+-------------+-------------+
| Provided by     | Hash starts with | Example Hash                                                            | Algorithm           | Salt length |             |
+=================+==================+=========================================================================+=====================+=============+=============+
| saltedpasswords | $2a$             | $2a$07$Oj0cP9TEac5Ko5udcan75.WgsNMyjVHP22XmcCcDbZTeM4ZNUmoJy            | Blowfish            | 16 B = 22 C | PHP         |
+-----------------+------------------+-------------------------------------------------------------------------+---------------------+-------------+-------------+
| saltedpasswords | $1$              | $1$/YVOTbAL$ywdTQ/gZjZMVybxKaRWGF/                                      | MD5                 | 6 B = 8 C   | PHP crypt   |
+-----------------+------------------+-------------------------------------------------------------------------+---------------------+-------------+-------------+
| saltedpasswords | $P$              | $P$Cqyeu8sTii7eJHAS5NHR9NARwB1.on/                                      | MD5, key stretching | 6 B = 8 C   | PHPass      |
+=================+==================+=========================================================================+=====================+=============+=============+
| extrasalt       | $2y$             | $2y$14$ZADNl.UOPmN.LN/i/shXceDQw/nWwqWg8/QG26//TdAiawjyrxYgq            | Blowfish            | 16 B = 22 C | PHP > 5.3.7 |
+-----------------+------------------+-------------------------------------------------------------------------+---------------------+-------------+-------------+

Further Information:
--------------------

* Feature #79795: https://forge.typo3.org/issues/79795

  this feature probably resolves the issue this extension was written for

Thoughts and Questions
----------------------

* How should TYPO3 react if an invalid salted password is found in the database ?
* make cost configurable with typoscript ?

