DOCUMENT = documentFinal
all:
	pdflatex $(DOCUMENT).tex -halt-on-error

clean:
	rm --force $(DOCUMENT).log
	rm --force $(DOCUMENT).aux
	rm --force $(DOCUMENT).pdf
	rm --force $(DOCUMENT).idx
	rm --force $(DOCUMENT).lof
	rm --force $(DOCUMENT).lot
	rm --force $(DOCUMENT).out
	rm --force $(DOCUMENT).toc
