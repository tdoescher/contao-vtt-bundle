# Erweitert den Contao Video-Player um die Unterstützung von Untertiteln (.vtt)

Diese Modul ermöglicht es euch im Contao Video-Element die zusätzliche Auswahl von Untertitel-Dateien im .vtt-Format.

## Verwendung

Standardmäßig wird der **Typ** auf `kind="subtitles"` in Verbindung mit der aktuellen Seitensprache gesetzt:

```
<track src="files/video/subtitles-movie.vtt" label="Untertitel" kind="subtitles" srclang="de">
```

Beinhaltet die Datei eine andere Sprache, als die aktuell verwendete, kann diese explizit mittels zweiter Dateierweiterung angegeben werden:

```
<track src="files/video/subtitles-movie.en.vtt" label="Untertitel" kind="subtitles" srclang="en">
<track src="files/video/subtitles-movie.es.vtt" label="Untertitel" kind="subtitles" srclang="es">
...
```

Um den **Typ** `kind="(captions|chapters|descriptions|metadata)"` der Datei zu ändern, kann dieser ebenfalls als zweite Dateierweiterung angehängt werden.

```
subtitles-movie.captions.vtt
subtitles-movie.chapters.vtt
...
```

Das **Label** wird aus den im Contao-Backend angegebenen Metadaten ermittelt.