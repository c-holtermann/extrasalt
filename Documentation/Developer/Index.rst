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

+-----------------+------------------+-------------------------------------------------------------------------+
| Provided by     | Hash starts with | Example Hash                                                            |
+=================+==================+=========================================================================+
| saltedpasswords | $2a$             |                                                                         |
+-----------------+------------------+-------------------------------------------------------------------------+
| extrasalt       | $2y$             | $2y$14$ZADNl.UOPmN.LN/i/shXceDQw/nWwqWg8/QG26//TdAiawjyrxYgq            |
+-----------------+------------------+-------------------------------------------------------------------------+


Further Information:
--------------------

* Feature #79795: https://forge.typo3.org/issues/79795

  this feature probably resolves the issue this extension was written for

Thoughts and Questions
----------------------

* How should TYPO3 react if an invalid salted password is found in the database ?

