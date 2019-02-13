public class RandomTester2 {
	private static final int NUM_RANDOMS = 100000000;
	public static int NUM_TASKS = 16;
	public static void main(String[] args) throws Exception { 
		long st = System.currentTimeMillis();
		int size = NUM_RANDOMS/NUM_TASKS;
		MyTask[] tasks = new MyTask[NUM_TASKS];
		Thread[] threads = new Thread[NUM_TASKS];
		
		for (int i=0; i < NUM_TASKS; i++) {
			tasks[i] = new MyTask(size);
			threads[i] = new Thread(tasks[i]);
			threads[i].start();
			}
		
		for (int i=0; i < NUM_TASKS; i++){
			threads[i].join();
		}
		
		int total = 0;
		for (int i=0; i < NUM_TASKS; i++) {
		   total = total + tasks[i].getCount();
		      }
		
		long et = System.currentTimeMillis(); 
		System.out.println(((double) total) /NUM_RANDOMS + "%"); 
		System.out.println("Execution time: " + (et-st) + " ms.");
	} 
}




