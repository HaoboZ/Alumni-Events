copy_haobo:
	cp -r * /webpages/hzhang/COEN174

copy_alfredo:
	scp -r * salfredo@linux.scudc.scu.edu:/webpages/salfredo/COEN174

clean_haobo:
	rm -rf /webpages/hzhang/COEN174/*

clean_alfredo:
	rm -rf /webpages/salfredo/COEN174/*

activate_haobo:
	chmod -R 715 /webpages/hzhang/*

activate_alfredo:
	chmod -R 715 /webpages/salfredo/*
