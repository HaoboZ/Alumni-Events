username = hzhang

copy:
	scp -r * $(username)@linux.scudc.scu.edu:/webpages/$(username)/COEN174

clean:
	rm -rf /webpages/$(username)/COEN174/*

activate:
	chmod -R 715 /webpages/$(username)/*
